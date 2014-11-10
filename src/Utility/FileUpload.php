<?php
/**
 * 文件上传工具
 *
 * @copyright LeeAdmin
 * @license   MIT License (http://www.opensource.org/licenses/mit-license.php)
 * @author    Will.Lee <im.will.lee@gmail.com>
 * @package   App.Utility
 */
namespace App\Utility;

use Intervention\Image\ImageManagerStatic as Image;
use stdClass;

class FileUpload {

/**
 * 上传配置项
 *
 * @var array
 */
	public $options = [
		// 上传文件保存目录
		'upload_dir' => UPLOAD_DIR,
		// 上传后访问url
		'preview_url' => '/uploads/',
		// 创建目录权限
		'mkdir_mode' => 0755,
		// 文件名保存规则 默认以原名保存
		// hash 文件hash值
		// uniqid 唯一ID
		'save_rule' => null,
		// 上传文件对象参数名
		'param_name' => 'files',
		// 允许上传文件 正则表达式
		'accept_file_types' => '/.+$/i',
		// 文件最大限制
		'max_file_size' => null,
		// 文件最小限制
		'min_file_size' => null,
		// 图片类型定义
		'image_file_types' => '/\.(gif|jpe?g|png)$/i',
		// 缩略图生成规则 默认不生成缩略图
		// 数组key会生成目录 当key为空时替换原图
		'thumbnail_rule' => [
			/*
			'small' => [
				// 缩略图保存路径(默认为当前图片路径下对应文件夹内)
				//'upload_dir' => UPLOAD_DIR,
				// 缩略图访问url(默认为当前图片路径下对应文件夹内)
				// 'preview_url' => '/uploads/small-test/',
				// 自动旋转方向
				'orientate' => true,
				// 是否裁剪
				//'crop' => true,
				// 最大宽度
				'max_width' => 80,
				// 最大高度
				'max_height' => 80
			],
			'' => [
				// 自动旋转方向
				'orientate' => true,
				// 是否裁剪
				'crop' => true,
				// 最大宽度
				'max_width' => 340,
				// 最大高度
				'max_height' => 340
			]
			*/
		],
		// 生成缩略图引擎 支持gd、imagick
		'thumbnail_driver' => 'gd',
	];

/**
 * 错误信息
 *
 * @var array
 */
	public $errorMessages = [
		1 => '上传的文件超过了 php.ini 中 upload_max_filesize 选项限制的值。',
		2 => '上传文件的大小超过了 HTML 表单中 MAX_FILE_SIZE 选项指定的值。',
		3 => '文件只有部分被上传。',
		4 => '没有文件被上传。',
		6 => '找不到临时文件夹。',
		7 => '文件写入失败。',
		8 => 'php扩展导致上传终止。',
		'mkdir' => '文件上传目录创建失败。',
		'max_file_size' => '上传文件超出最大限制。',
		'min_file_size' => '上传文件低于最小限制。',
		'accept_file_types' => '上传文件不在允许类型之内。',
		'move_uploaded_file' => '文件上传目录失败，请检查目录权限。',
		'abort' => '文件上传被终止。',
		'mkdir_thumbnail' => '缩略图保存目录创建失败。',
		'make_thumbnail' => '缩略图生成失败。'
	];

/**
 * 上传文件对象
 *
 * @var array
 */
	public $fileObjects = [];

/**
 * 构造函数
 *
 * @param array $options 自定义配置项
 * @param array $errorMessages 自定义错误信息
 */
	public function __construct($options = [], $errorMessages = []) {
		if (!empty($options)) {
			$this->options = array_merge($this->options, $options);
		}
		if (!empty($errorMessages)) {
			$this->errorMessages = array_merge($this->errorMessages, $errorMessages);
		}
		// 上传文件信息
		$files = isset($_FILES[$this->options['param_name']]) ? $_FILES[$this->options['param_name']] : null;
		if (!empty($files['tmp_name'])) {
			if (is_array($files['tmp_name'])) {
				foreach ($files['tmp_name'] as $i => $file) {
					$this->_addendToFileObjects(
						$files['name'][$i],
						$files['tmp_name'][$i],
						$files['size'][$i],
						$files['type'][$i],
						$files['error'][$i],
						$i
					);
				}
			} else {
				$this->_addendToFileObjects(
					$files['name'],
					$files['tmp_name'],
					$files['size'],
					$files['type'],
					$files['error']
				);
			}
		}
		unset($files);
	}

/**
 * 保存文件
 *
 * @return void
 */
	public function saveFiles() {
		foreach ($this->fileObjects['files'] as $file) {
			// 上传文件验证
			if ($this->_validate($file)) {
				// 移动文件到保存目录
				if ($this->_moveFileToUploadDir($file)) {
					// 生成缩略图
					$this->_makeThumbnail($file);
				}
			}
			if (isset($file->uploadPath)) {
				unset($file->uploadPath);
			}
			if (is_file($file->tmpName)) {
				unlink($file->tmpName);
			}
			unset($file->tmpName);
		}
		return $this->fileObjects;
	}

/**
 * 移动文件到保存目录
 *
 * @param stdClass $file 文件对象
 * @return boolean
 */
	protected function _moveFileToUploadDir($file) {
		$uploadDir = $this->_getUploadDir();
		if (!is_dir($uploadDir)) {
			if (!mkdir($uploadDir, $this->options['mkdir_mode'], true)) {
				$file->error = $this->_getErrorMessage('mkdir');
				return false;
			}
		}
		$this->_setFileSaveName($uploadDir, $file);
		$uploadPath = $uploadDir . $file->name;
		if (is_uploaded_file($file->tmpName)) {
			if (!move_uploaded_file($file->tmpName, $uploadPath)) {
				$file->error = $this->_getErrorMessage('move_uploaded_file');
				return false;
			}
			$file->uploadPath = $uploadPath;
			$file->previewUrl = $this->options['preview_url'] . rawurlencode($file->name);
		} else {
			$file->error = $this->_getErrorMessage('abort');
			return false;
		}
		return true;
	}

/**
 * 移动文件到保存目录
 *
 * @param stdClass $file 文件对象
 * @return void
 */
	protected function _makeThumbnail($file) {
		// 判断是否是图片类型的文件
		if (preg_match($this->options['image_file_types'], $file->name)) {
			$file->isImage = true;
			if (!empty($this->options['thumbnail_rule'])) {
				foreach ($this->options['thumbnail_rule'] as $rule => $option) {
					// 最大高宽参数
					$maxHeight = isset($option['max_height']) ? $option['max_height'] : null;
					$maxWidth = isset($option['max_width']) ? $option['max_width'] : null;
					if (!$maxHeight && !$maxWidth) {
						$file->error = $this->_getErrorMessage('make_thumbnail');
						break;
					}
					$thumbnailDir = $this->_getThumbnailDir($rule);
					if (!is_dir($thumbnailDir)) {
						if (!mkdir($thumbnailDir, $this->options['mkdir_mode'], true)) {
							$file->error = $this->_getErrorMessage('mkdir_thumbnail');
							break;
						}
					}
					// 缩略图保存路径
					$thumbnailPath = $thumbnailDir . $file->name;
					// 使用imagick扩展
					if ($this->options['thumbnail_driver'] === 'imagick') {
						Image::configure(array('driver' => 'imagick'));
					}
					$img = Image::make($file->uploadPath);
					// 原始图片高宽
					$height = $img->height();
					$width = $img->width();
					if ($height < $maxHeight) {
						$maxHeight = $height;
					}
					if ($width < $maxWidth) {
						$maxWidth = $width;
					}
					if (isset($option['orientate']) && $option['orientate']) {
						$img->orientate();
					}
					if (isset($option['crop']) && $option['crop']) {
						$img->crop($maxWidth, $maxHeight);
					} else {
						$img->resize($maxWidth, $maxHeight);
					}

					if ($img->save($thumbnailPath)) {
						if ($rule !== '') {
							$file->{$rule . 'Url'} = $this->_getThumbnailPreviewUrl($file, $rule) . rawurlencode($file->name);
						}
					} else {
						$file->error = $this->_getErrorMessage('make_thumbnail');
						break;
					}
				}
			}
		}
	}

/**
 * 取得缩略图保存目录
 *
 * @param string $rule 缩略图生成规则索引
 * @return string
 */
	protected function _getThumbnailDir($rule = '') {
		$uploadDir = $this->_getUploadDir();
		$option = isset($this->options['thumbnail_rule'][$rule]) ? $this->options['thumbnail_rule'][$rule] : null;
		if ($option) {
			if ($rule !== '') {
				if (isset($option['upload_dir']) && $option['upload_dir'] != '') {
					return $option['upload_dir'];
				} else {
					return $uploadDir . $rule . DS;
				}
			}
		}
		return $uploadDir;
	}

/**
 * 取得文件保存目录
 *
 * @return string
 */
	protected function _getUploadDir() {
		return $this->options['upload_dir'];
	}

/**
 * 取得缩略图预览url
 *
 * @param stdClass $file 文件对象
 * @param string $rule 缩略图生成规则索引
 * @return string
 */
	protected function _getThumbnailPreviewUrl($file, $rule = '') {
		$previewUrl = $this->options['preview_url'];
		$option = isset($this->options['thumbnail_rule'][$rule]) ? $this->options['thumbnail_rule'][$rule] : null;
		if ($option) {
			if ($rule !== '') {
				if (isset($option['preview_url']) && $option['preview_url'] != '') {
					return $option['preview_url'];
				} else {
					return $previewUrl . $rule . '/';
				}
			}
		}
		return $previewUrl;
	}

/**
 * 设置文件保存文件名
 *
 * @param string $uploadDir 上传目录
 * @param stdClass $file 文件对象
 * @return void
 */
	protected function _setFileSaveName($uploadDir, $file) {
		$fileInfo = pathinfo($file->name);
		if (!$this->options['save_rule']) {
			$filename = $fileInfo['filename'];
		} else {
			switch ($this->options['save_rule']) {
				case 'hash':
					$filename = $file->hash;
					break;
				case 'uniqid':
					$filename = str_replace('.', '', uniqid($file->index, true));
					break;
				default:
					$filename = $file->hash;
					break;
			}
		}
		$basename = sprintf('%s.%s', $filename, $fileInfo['extension']);
		// 如果文件存在重复命名
		if (is_file($uploadDir . $basename)) {
			$i = 0;
			while (true) {
				$basename = sprintf('%s-%s.%s', $filename, $i, $fileInfo['extension']);
				if (!is_file($uploadDir . $basename)) {
					$file->name = $basename;
					break;
				}
				$i++;
			}
		}
		$file->name = $basename;
	}

/**
 * 上传文件验证
 *
 * @param stdClass $file 文件对象
 * @return boolean
 */
	protected function _validate($file) {
		if ($file->error) {
			$file->error = $this->_getErrorMessage($file->error);
			return false;
		}
		// 文件最大限制
		if ($this->options['max_file_size']) {
			if ($file->size > $this->options['max_file_size']) {
				$file->error = $this->_getErrorMessage('max_file_size');
				return false;
			}
		}
		// 文件最小限制
		if ($this->options['min_file_size']) {
			if ($file->size < $this->options['min_file_size']) {
				$file->error = $this->_getErrorMessage('min_file_size');
				return false;
			}
		}
		// 文件类型限制
		if (!preg_match($this->options['accept_file_types'], $file->name)) {
			$file->error = $this->_getErrorMessage('accept_file_types');
			return false;
		}
		return true;
	}

/**
 * 根据索引取得错误信息
 *
 * @param string $key 索引
 * @return string
 */
	protected function _getErrorMessage($key) {
		return isset($this->errorMessages[$key]) ? $this->errorMessages[$key] : null;
	}

/**
 * 文件信息添加到对象列表
 *
 * @param string $name 文件名
 * @param string $tmpName 临时路径
 * @param int $size 文件大小
 * @param string $type 文件类型
 * @param int $error 错误代码
 * @param int $index 索引
 * @return void
 */
	protected function _addendToFileObjects($name, $tmpName, $size, $type, $error, $index = null) {
		$file = new stdClass();
		$file->name = rawurlencode($name);
		$file->tmpName = $tmpName;
		$file->size = $size;
		$file->type = $type;
		$file->error = $error;
		$file->hash = md5_file($tmpName);
		$file->index = $index;
		$this->fileObjects['files'][] = $file;
	}
}

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

use stdClass;

class FileUpload {

/**
 * 上传配置项
 *
 * @var array
 */
	public $options = [
		// 上传文件保存目录
		'upload_dir' => UPLOAD_PATH,
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
		// 数组key会生成目录 当key为original时替换原图
		'thumbnail_rule' => [
			/*
			'small' => [
				// 缩略图保存路径(默认为当前图片路径下对应文件夹内)
				'upload_dir' => UPLOAD_PATH,
				// 缩略图访问url(默认为当前图片路径下对应文件夹内)
				'upload_url' => '/uploads/thumb/',
				// 自动旋转方向
				'auto_orient' => true,
				// 是否裁剪
				'crop' => true,
				// 最大宽度
				'max_width' => 80,
				// 最大高度
				'max_height' => 80
			]
			*/
		],
		// 生成缩略图引擎
		// 'thumbnail_engine' => 1,
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
		'image_resize' => '调整图片尺寸失败。'
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
		foreach ($this->fileObjects as $file) {
			if ($this->_validate($file)) {
				$this->_moveFileToUploadDir($file);
			}
			if (is_file($file->tmp_name)) {
				unlink($file->tmp_name);
			}
			unset($file->tmp_name);
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
				$file->error_message = $this->_getErrorMessage('mkdir');
				return false;
			}
		}
		$this->_setFileSaveName($uploadDir, $file);
		$uploadPath = $uploadDir . DS . $file->name;
		if (is_uploaded_file($file->tmp_name)) {
			if (!move_uploaded_file($file->tmp_name, $uploadPath)) {
				$file->error_message = $this->_getErrorMessage('move_uploaded_file');
				return false;
			}
		} else {
			$file->error_message = $this->_getErrorMessage('abort');
			return false;
		}
		return true;
	}

/**
 * 取得文件保存目录
 *
 * @param string $tr 缩略图配置项索引
 * @return string
 */
	protected function _getUploadDir($tr = null) {
		if ($tr) {
			$thumbnailRule = isset($this->options['thumbnail_rule'][$tr]) ? $this->options['thumbnail_rule'][$tr] : null;
			if ($thumbnailRule && $tr != 'original') {
				if (isset($thumbnailRule['upload_dir']) && $thumbnailRule['upload_dir'] != '') {
					return $thumbnailRule['upload_dir'];
				} else {
					return $this->options['upload_dir'] . $tr . DS;
				}
			}
		}
		return $this->options['upload_dir'];
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
			$file->error_message = $this->_getErrorMessage($file->error);
			return false;
		}
		// 文件最大限制
		if ($this->options['max_file_size']) {
			if ($file->size > $this->options['max_file_size']) {
				$file->error_message = $this->_getErrorMessage('max_file_size');
				return false;
			}
		}
		// 文件最小限制
		if ($this->options['min_file_size']) {
			if ($file->size < $this->options['min_file_size']) {
				$file->error_message = $this->_getErrorMessage('min_file_size');
				return false;
			}
		}
		// 文件类型限制
		if (!preg_match($this->options['accept_file_types'], $file->name)) {
			$file->error_message = $this->_getErrorMessage('accept_file_types');
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
		$file->tmp_name = $tmpName;
		$file->size = $size;
		$file->type = $type;
		$file->error = $error;
		$file->hash = md5_file($tmpName);
		$file->index = $index;
		$this->fileObjects[] = $file;
	}
}

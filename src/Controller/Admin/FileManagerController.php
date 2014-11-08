<?php
/**
 * 文件管理器控制器
 *
 * @copyright LeeAdmin
 * @license   MIT License (http://www.opensource.org/licenses/mit-license.php)
 * @author    Will.Lee <im.will.lee@gmail.com>
 * @package   App.Controller.Admin
 */
namespace App\Controller\Admin;

use App\Controller\AppAdminController;
use App\Utility\UploadHandler;
use Cake\Core\Configure;
use Cake\Event\Event;
use Cake\Filesystem\File;
use Cake\Filesystem\Folder;
use Cake\Routing\Router;
use Cake\Validation\Validator;

class FileManagerController extends AppAdminController {

/**
 * 主标题
 *
 * @var string
 */
	protected $_mainTitle = '文件管理器';

/**
 * 控制器操作执行前回调方法
 *
 * @param Cake\Event\Event $event 事件对象
 * @return void
 */
	public function beforeFilter(Event $event) {
		$this->Security->config('unlockedActions', ['upload']);
		parent::beforeFilter($event);
		// 文件管理根路径
		$this->_rootPath = ROOT . DS;
	}

/**
 * 文件一览
 *
 * @return void
 */
	public function index() {
		$this->_subTitle = '文件一览';
		$fullPath = $this->_rootPath;
		$path = urldecode($this->request->query('path'));
		$breadcrumbs = [];
		if ($path) {
			$fullPath = $this->__fullPath($path);
			$breadcrumbs = explode(DS, $path);
		}
		if (!$this->__inPath($fullPath)) {
			$this->Flash->error('无权限访问该路径！');
			return $this->redirect(['action' => 'index']);
		}
		$folder = new Folder($fullPath);
		$files = $folder->read(true, ['.git', '.svn']);
		$this->set(compact('path', 'breadcrumbs', 'files'));
	}

/**
 * 上传文件
 *
 * @return void
 */
	public function upload() {
		if ($this->request->is('post')) {
			$this->autoRender = false;
			$path = urldecode($this->request->data('path'));
			if ($path) {
				$fullPath = $this->__fullPath($path);
			} else {
				$fullPath = WWW_ROOT;
			}
			$options = [
				'upload_dir' => $fullPath . DS,
				'upload_url' => Router::url(['action' => 'preview']) . '?path=' . $path . DS,
				'script_url' => Router::url(['action' => 'upload']),
				'accept_file_types' => '/\.(gif|jpe?g|png)$/i',
				'param_name' => 'files',
				'delete_type' => 'GET',
				'user_dirs' => false,
				//'image_versions' => [],
				'max_file_size' => 10 * 1024 * 1024
			];
			$upload = new UploadHandler($options);
		} else {
			$this->_subTitle = '上传文件';
			$path = urldecode($this->request->query('path'));
			$breadcrumbs = [];
			if ($path) {
				$breadcrumbs = explode(DS, $path);
				$fullPath = $this->__fullPath($path);
			} else {
				$fullPath = $this->_rootPath;
			}
			if (!$this->__inPath($fullPath)) {
				$this->Flash->error('无权限访问该路径！');
				return $this->redirect(['action' => 'index']);
			}
			$this->set(compact('path', 'breadcrumbs'));
		}
	}

/**
 * 创建目录
 *
 * @return void
 */
	public function mkdir() {
		$this->layout = 'popup';
		$this->_subTitle = '创建目录';
		$path = $errors = null;
		if ($this->request->is('post')) {
			$path = $this->request->data('path');
			$fullPath = $this->__fullPath(urldecode($path) . DS . $this->request->data('dir_name'));
			$validator = new Validator();
			$validator
				->validatePresence('path', true, '创建路径项目不存在！')
				->allowEmpty('path')
				->validatePresence('dir_name', true, '目录名称项目不存在！')
				->notEmpty('dir_name', '目录名称必须填写！')
				->add('dir_name', [
					'custom' => [
						'rule' => function ($value, $context) {
							return !strpbrk($value, '\\/?%*:|\"<>');
						},
						'message' => '目录名称格式错误！',
						'last' => true
					],
					'exist' => [
						'rule' => function ($value, $context) use ($fullPath) {
							return !is_dir($fullPath);
						},
						'message' => '目录名称已存在！',
						'last' => true
					]
				]);
			$errors = $validator->errors($this->request->data());
			if (empty($errors)) {
				$folder = new Folder();
				if ($folder->create($fullPath, 0755)) {
					$this->Flash->success('目录创建成功！');
				} else {
					$this->Flash->error('目录创建失败！');
				}
			}
		} else {
			$path = $this->request->query('path');
		}
		$this->set(compact('path', 'errors'));
	}

/**
 * 文件编辑
 *
 * @return void
 */
	public function edit() {
		$content = null;
		if ($this->request->is('get')) {
			$path = urldecode($this->request->query('path'));
		} else {
			$path = urldecode($this->request->data('path'));
		}
		$breadcrumbs = [];
		$fullPath = $this->__fullPath($path);
		if ($path && $this->__inPath($fullPath)) {
			$file = new File($fullPath);
			$breadcrumbs = explode(DS, $path);
			if ($this->request->is('post')) {
				$content = $this->request->data('content');
				if ($file->write($content)) {
					$this->Flash->success('文件保存成功！');
				} else {
					$this->Flash->error('文件保存失败！请检查是否有写入权限。');
				}
			} else {
				$content = $file->read();
			}
			$file->close();
		} else {
			$this->Flash->error('参数错误或无权限访问该路径！');
			return $this->redirect(['action' => 'index']);
		}
		$this->set(compact('path', 'breadcrumbs', 'content'));
	}

/**
 * 删除文件或目录
 *
 * @return void
 */
	public function delete() {
		$this->request->allowMethod('post', 'delete');
		$path = false;
		if ($this->request->query('file')) {
			$path = urldecode($this->request->query('file'));
		} elseif ($this->request->query('dir')) {
			$path = urldecode($this->request->query('dir'));
		}
		$fullPath = $this->__fullPath($path);
		if (!$path || !$this->__inPath($fullPath)) {
			$this->Flash->error('无权限访问该路径！');
		} else {
			if (is_dir($fullPath)) {
				$folder = new Folder($fullPath);
				if ($folder->delete()) {
					$this->Flash->success('目录删除成功！');
				} else {
					$this->Flash->error('目录删除失败!');
				}
			} elseif (is_file($fullPath)) {
				$file = new File($fullPath);
				if ($file->delete()) {
					$this->Flash->success('文件删除成功！');
				} else {
					$this->Flash->error('文件删除失败!');
				}
			}
		}
		return $this->redirect(['action' => 'index']);
	}

/**
 * 图片预览
 *
 * @return void
 */
	public function preview() {
		$path = urldecode($this->request->query('path'));
		if ($path) {
			$fullPath = $this->__fullPath($path);
			if ($this->__inPath($fullPath)) {
				$this->response->file($fullPath);
			}
		}
		return $this->response;
	}

/**
 * 文件下载
 *
 * @return void
 */
	public function download() {
		$path = urldecode($this->request->query('path'));
		if ($path) {
			$fullPath = $this->__fullPath($path);
			if ($this->__inPath($fullPath)) {
				$this->response->file($fullPath, ['download' => true]);
			}
		}
		return $this->response;
	}

/**
 * 检查访问路径是否在允许路径内
 *
 * @param string $path 访问路径
 * @return boolean
 */
	private function __inPath($path = false) {
		if (empty($path)) {
			return false;
		}
		if (is_file($path)) {
			$path = dirname($path);
		}
		$folder = new Folder($path);
		return $folder->inPath($this->_rootPath);
	}

/**
 * 完整路径
 *
 * @param string $path 访问路径
 * @return string
 */
	private function __fullPath($path = false) {
		if (empty($path)) {
			return false;
		}
		$folder = new Folder();
		return $folder->realpath($this->_rootPath . $path);
	}
}

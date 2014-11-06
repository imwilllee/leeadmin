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
use Cake\Core\Configure;
use Cake\Event\Event;
use Cake\Filesystem\File;
use Cake\Filesystem\Folder;

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
			$path .= DS;
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
		$this->_subTitle = '上传文件';
	}

/**
 * 创建目录
 *
 * @return void
 */
	public function mkdir() {
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
		return $this->_rootPath . $path;
	}
}

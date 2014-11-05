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
use Cake\Filesystem\File;
use Cake\Filesystem\Folder;
use Cake\Event\Event;

class FileManagerController extends AppAdminController {

/**
 * 模板助手
 *
 * @var array
 */
	public $helpers = [];

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
		$dir = $this->_rootPath;
		$path = urldecode($this->request->query('path'));
		$breadcrumbs = [];
		if ($path) {
			$dir .= $path;
			$breadcrumbs = explode(DS, $path);
			$path .= DS;
		}
		if (!$this->_isEditable($dir)) {
			$this->Flash->error('无权限访问该路径！');
			return $this->redirect(['action' => 'index']);
		}
		$folder = new Folder($dir);
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
 * 文件编辑
 *
 * @return void
 */
	public function edit() {
	}

/**
 * 图片预览
 *
 * @return void
 */
	public function preview() {
		$path = urldecode($this->request->query('path'));
		if ($path) {
			$file = $this->_rootPath . $path;
			if ($this->_isEditable($file)) {
				$this->response->file($file);
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
			$file = $this->_rootPath . $path;
			if ($this->_isEditable($file)) {
				$this->response->file($file, ['download' => true]);
			}
		}
		return $this->response;
	}

/**
 * 检查是否为可访问可编辑的目录
 *
 * @param string $path 绝对路径
 * @return boolean
 */
	protected function _isEditable($path) {
		$path = realpath($path);
		$regex = '/^' . preg_quote(realpath($this->_rootPath), '/') . '/';
		return preg_match($regex, $path) > 0;
	}
}

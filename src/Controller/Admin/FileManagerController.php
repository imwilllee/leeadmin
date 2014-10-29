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
use Cake\Filesystem\Folder;
use Cake\Filesystem\File;

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
 * 文件一览
 *
 * @return void
 */
	public function index() {
		$this->_subTitle = '文件一览';
		$root = WWW_ROOT;
		$pwd = urldecode($this->request->query('pwd'));
		$breadcrumbs = [];
		if ($pwd) {
			$root .= $pwd;
			$breadcrumbs = explode(DS, $pwd);
			$pwd .= DS;
		}
		$folder = new Folder($root);
		$files = $folder->read(true, ['.git', '.svn']);
		$this->set(compact('pwd', 'breadcrumbs', 'files'));
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
 * 检查是否为可访问可编辑的目录
 *
 * @param string $path 绝对路径
 * @return boolean
 */
	protected function _isEditable($path) {
		$path = realpath($path);
		$regex = '/^' . preg_quote(realpath(APP), '/') . '/';
		return preg_match($regex, $path) > 0;
	}
}

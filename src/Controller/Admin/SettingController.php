<?php
/**
 * 系统设置控制器
 *
 * @copyright LeeAdmin
 * @license   MIT License (http://www.opensource.org/licenses/mit-license.php)
 * @author    Will.Lee <im.will.lee@gmail.com>
 * @package   App.Controller.Admin
 */
namespace App\Controller\Admin;

use App\Controller\AppAdminController;

class SettingController extends AppAdminController {

/**
 * 主标题
 *
 * @var string
 */
	protected $_mainTitle = '系统设置';

/**
 * 站点信息
 *
 * @return void
 */
	public function index() {
		$this->_subTitle = '站点信息';
	}

/**
 * 管理菜单排序
 *
 * @return void
 */
	public function menus() {
		$this->_subTitle = '管理菜单排序';
		$this->loadModel('Menus');
	}

}

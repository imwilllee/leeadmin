<?php
/**
 * 用户管理控制器
 *
 * @copyright LeeAdmin
 * @license   MIT License (http://www.opensource.org/licenses/mit-license.php)
 * @author    Will.Lee <im.will.lee@gmail.com>
 * @package   App.Controller.Admin
 */
namespace App\Controller\Admin;

use App\Controller\AppAdminController;
use Cake\ORM\TableRegistry;

class UsersController extends AppAdminController {

/**
 * 控制器标题
 * 
 * @var string
 */
	protected $_controllerTitle = '用户管理';

/**
 * 管理员登陆
 * 
 * @return void
 */
	public function login() {
		$this->layout = false;
		$this->_controllerTitle = '管理员登陆';
		if ($this->request->is('post')) {
			return $this->redirect(['controller' => 'Dashboard', 'action' => 'index', 'prefix' => 'admin']);
		}
	}

/**
 * 用户退出
 * 
 * @return void
 */
	public function logout() {
	}

/**
 * 用户管理
 * 
 * @return void
 */
	public function index() {
	}

/**
 * 用户详细
 * 
 * @param int $id 用户ID
 * @return void
 */
	public function view($id = null) {
	}

/**
 * 创建用户
 * 
 * @return void
 */
	public function create() {
	}

/**
 * 用户编辑
 * 
 * @param int $id 用户ID
 * @return void
 */
	public function edit($id = null) {
	}
}

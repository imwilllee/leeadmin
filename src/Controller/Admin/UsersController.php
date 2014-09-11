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
use Cake\Core\Configure;
use Cake\Event\Event;
use Cake\ORM\TableRegistry;
use DateTime;

class UsersController extends AppAdminController {

/**
 * 主标题
 * 
 * @var string
 */
	protected $_mainTitle = '用户管理';

/**
 * 控制器操作执行前回调方法
 * 
 * @param Cake\Event\Event $event 事件对象
 * @return void
 */
	public function beforeFilter(Event $event) {
		// 允许不登陆访问的操作
		$this->Auth->allow(['login', 'logout']);
		parent::beforeFilter($event);
	}

/**
 * 管理员登陆
 * 
 * @return void
 */
	public function login() {
		$this->layout = false;
		$this->_mainTitle = '管理员登陆';
		// 已登录状态自动跳转
		if ($this->Auth->user()) {
			return $this->redirect($this->Auth->redirectUrl());
		}
		if ($this->request->is('post')) {
			// 登录信息验证
			$user = $this->Auth->identify();
			if ($user !== false) {
				if ($user['status'] === false) {
					$this->Flash->warning('该账号已被限制登录！');
				} else {
					// 设置登录信息
					$this->Auth->setUser($user);
					// 更新登录信息
					$this->_updateLastLoginInfo($user);
					return $this->redirect($this->Auth->redirectUrl());
				}
			} else {
				$this->Flash->error('邮箱不存在或者密码错误！');
			}
		}
	}

/**
 * 用户退出
 * 
 * @return void
 */
	public function logout() {
		$this->Flash->success('系统退出成功！');
		$this->Cookie->delete('SIDEBAR_PARENT_IDS');
		return $this->redirect($this->Auth->logout());
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

/**
 * 更新用户最后登录信息
 * 
 * @param array $user 登录用户信息
 * @return void
 */
	protected function _updateLastLoginInfo($user) {
		$usersTable = TableRegistry::get('Users');
		$update = [
			'id' => $user['id'],
			'last_logined' => new DateTime('now'),
			'last_login_ip' => $this->request->clientIp(),
			'last_user_agent' => $this->request->env('HTTP_USER_AGENT'),
			'modified_by' => $user['id']
		];
		$entity = $usersTable->newEntity($update);
		// 设置为更新数据
		$entity->isNew(false);
		$usersTable->save($entity);
	}
}

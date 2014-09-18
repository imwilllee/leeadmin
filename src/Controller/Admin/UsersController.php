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
	protected $_mainTitle = '系统管理员';

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
					// 设置权限
					$this->__setUserAccess($user);
					// 更新登录信息
					$this->__updateLastLoginInfo($user);
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
		return $this->redirect($this->Auth->logout());
	}

/**
 * 管理员管理
 * 
 * @return void
 */
	public function index() {
		$this->_subTitle = '管理员一览';
		$usersTable = TableRegistry::get('Users');
		$this->paginate = array_merge($this->paginate, ['sortWhitelist' => ['id', 'status']]);
		$this->set('users', $this->paginate($usersTable));
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
	public function add() {
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
	private function __updateLastLoginInfo($user) {
		$usersTable = TableRegistry::get('Users');
		$query = $usersTable->query();
		$query->update()
			->set([
				'last_logined' => new DateTime('now'),
				'last_login_ip' => $this->request->clientIp(),
				'last_user_agent' => $this->request->env('HTTP_USER_AGENT')
			])
			->where(['id' => $user['id']])
			->execute();
	}

/**
 * 设置用户访问权限
 * 
 * @param array $user 登录用户信息
 * @return void
 */
	private function __setUserAccess($user) {
		$userAccess = [];
		if ($user['group_id'] != INIT_GROUP_ID) {
			$groupAccessesTable = TableRegistry::get('GroupAccesses');
			$userAccess = $groupAccessesTable->getGroupAccessNodeNameList($user['group_id']);
		}
		$this->request->session()->write('Auth.Access', $userAccess);
	}
}

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
		$this->loadModel('Users');
		$query = $this->Users->find()
					->select(
						[
							'Users.id',
							'Users.email',
							'Users.status',
							'Users.alias',
							'Users.group_id',
							'Users.last_logined',
							'Users.last_login_ip',
							'Users.created',
							'Groups.name'
						]
					)
					->contain(['Groups']);
		$this->__markQuery($query);
		$config = [
			'sortWhitelist' => [
				'Users.status',
				'Users.group_id',
				'Users.created',
				'Users.last_logined'
			]
		];
		$this->paginate = array_merge($this->paginate, $config);
		$users = $this->paginate($query);
		$this->loadModel('Groups');
		$groupList = $this->Groups->getGroupList();
		$this->set(compact('users', 'groupList') );
	}

/**
 * 组装查询条件
 *
 * @param Cake\ORM\Query $query 查询生成器
 * @return void
 */
	private function __markQuery($query) {
		if ($this->request->is('post')) {
			if ($this->request->data('q') != '') {
				$this->request->query['q'] = url_encode($this->request->data('q'));
			}
			if ($this->request->data('email') != '') {
				$this->request->query['email'] = url_encode($this->request->data('email'));
			}
			if ($this->request->data('group_id') != '') {
				$this->request->query['group_id'] = $this->request->data('group_id');
			}
			if ($this->request->data('status') != '') {
				$this->request->query['status'] = implode('_', $this->request->data('status'));
			}
		}
		if ($this->request->query('q') != '') {
			$this->request->data['q'] = url_decode($this->request->query('q'));
			$query->andWhere(function ($exp) {
				return $exp->or_([
					'Users.alias LIKE' => '%' . $this->request->data['q'] . '%',
					'Users.email' => $this->request->data['q']
				]);
			});
		}
		if ($this->request->query('email') != '') {
			$query->where(['Users.email' => $this->request->data['email']]);
		}
		if ($this->request->query('group_id') != '') {
			$query->where(['Users.group_id' => $this->request->data['group_id']]);
		}
		if ($this->request->query('status') != '') {
			$this->request->data['status'] = explode('_', $this->request->query('status'));
			if (!empty($this->request->data['status'])) {
				$query->where(['Users.status IN' => $this->request->data['status']]);
			}
		}
		if (!$this->request->query('sort')) {
			$query->order(['Users.id' => 'DESC']);
		}
	}

/**
 * 管理员详细
 *
 * @param int $id 用户ID
 * @return void
 */
	public function view($id = null) {
		$this->_subTitle = '管理员详细';
		$this->loadModel('Users');
		$user = $this->Users->get($id, ['contain' => ['Groups']]);
		$this->set(compact('user'));
	}

/**
 * 创建管理员
 *
 * @return void
 */
	public function add() {
		$this->_subTitle = '创建管理员';
		$this->loadModel('Users');
		$user = $this->Users->newEntity($this->request->data());
		if ($this->request->is('post')) {
			if ($this->Users->save($user)) {
				$this->Flash->success('数据保存成功！');
				return $this->redirect(['action' => 'index']);
			} else {
				$this->Flash->error('数据保存失败！');
			}
		}
		$this->loadModel('Groups');
		$groupList = $this->Groups->getGroupList();
		$this->set(compact('user', 'groupList'));
	}

/**
 * 管理员编辑
 *
 * @param int $id 管理员ID
 * @return void
 */
	public function edit($id = null) {
		$this->_subTitle = '管理员编辑';
		$this->loadModel('Users');
		$user = $this->Users->get($id, ['contain' => false]);
		// 去除密码项
		$user->unsetProperty('password');
		if ($this->request->is(['post', 'put'])) {
			$user = $this->Users->patchEntity($user, $this->request->data());
			if ($this->request->data('change_password')) {
				$user->set('user_password', $this->request->data('change_password'));
			}
			if ($this->Users->save($user)) {
				$this->Flash->success('数据保存成功！');
				return $this->redirect(['action' => 'index']);
			} else {
				$this->Flash->error('数据保存失败！');
			}
		}
		$this->loadModel('Groups');
		$groupList = $this->Groups->getGroupList();
		$this->set(compact('user', 'groupList'));
	}

/**
 * 删除管理员
 *
 * @param int $id 用户组ID
 * @return void
 */
	public function delete($id = null) {
		$this->request->allowMethod('post', 'delete');
		$this->loadModel('Users');
		$user = $this->Users->get($id, ['contain' => false]);
		if ($this->Users->delete($user)) {
			$this->Flash->success('数据删除成功！');
		} else {
			$this->Flash->error('数据删除失败！');
		}
		return $this->redirect(['action' => 'index']);
	}

/**
 * 状态变更
 *
 * @param string $status 状态
 * @return void
 */
	public function active($status = 'enable') {
		$this->autoRender = false;
		$ids = $this->request->query('id');
		if (empty($ids)) {
			$this->Flash->error('请选择至少选择一个项目！');
		} else {
			$ids = explode('_', $ids);
			$this->loadModel('Users');
			$query = $this->Users->query();
			$result = $query->update()
				->set([
					'status' => $status == 'enable',
					'modified' => new DateTime('now'),
					'modified_by' => $this->request->session()->read('Auth.User.id')
				])
				->where(['id IN' => $ids])
				->execute();
			if ($result) {
				$this->Flash->success('数据更新成功！');
			} else {
				$this->Flash->error('数据更新失败');
			}
		}
		return $this->redirect(['action' => 'index']);
	}

/**
 * 密码修改
 *
 * @return void
 */
	public function change_password() {
		$this->_subTitle = '密码修改';
		$user = null;
		if ($this->request->is(['post', 'put'])) {
			$this->loadModel('Users');
			$id = $this->request->session()->read('Auth.User.id');
			$user = $this->Users->patchEntity(
				$this->Users->get($id, ['contain' => false]),
				$this->request->data()
			);
			if ($this->Users->save($user, ['validate' => 'changePassword'])) {
				$this->Flash->success('密码修改成功，请重新登录系统！');
				return $this->redirect($this->Auth->logout());
			} else {
				$this->Flash->error('密码修改失败！');
			}
		}
		$this->set(compact('user'));
	}

/**
 * 更新用户最后登录信息
 *
 * @param array $user 登录用户信息
 * @return void
 */
	private function __updateLastLoginInfo($user) {
		$this->loadModel('Users');
		$query = $this->Users->query();
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
			$this->loadModel('GroupAccesses');
			$userAccess = $this->GroupAccesses->getGroupAccessNodeNameList($user['group_id']);
		}
		$this->request->session()->write('Auth.Access', $userAccess);
	}
}

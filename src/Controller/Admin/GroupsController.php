<?php
/**
 * 用户组控制器
 *
 * @copyright LeeAdmin
 * @license   MIT License (http://www.opensource.org/licenses/mit-license.php)
 * @author    Will.Lee <im.will.lee@gmail.com>
 * @package   App.Controller.Admin
 */
namespace App\Controller\Admin;

use App\Controller\AppAdminController;
use Cake\Network\Exception\NotFoundException;
use DateTime;

class GroupsController extends AppAdminController {

/**
 * 主标题
 *
 * @var string
 */
	protected $_mainTitle = '用户组管理';

/**
 * 用户组一览
 *
 * @return void
 */
	public function index() {
		$this->_subTitle = '用户组一览';
		$this->loadModel('Groups');
		$query = $this->Groups->find()->select(['id', 'name', 'status', 'explain']);
		$this->__markQuery($query);
		$this->paginate = array_merge($this->paginate, ['sortWhitelist' => ['id', 'status']]);
		$this->set('groups', $this->paginate($query));
	}

/**
 * 组装查询条件
 *
 * @param Cake\ORM\Query $query 查询生成器
 * @return void
 */
	private function __markQuery($query) {
		if ($this->request->is('post')) {
			if ($this->request->data('name') != '') {
				$this->request->query['name'] = urlencode($this->request->data('name'));
			}
			if ($this->request->data('status') != '') {
				$this->request->query['status'] = implode('_', $this->request->data('status'));
			}
		}
		if ($this->request->query('name') != '') {
			$this->request->data['name'] = urldecode($this->request->query('name'));
			$query->where(['name LIKE' => '%' . $this->request->data['name'] . '%']);
		}
		if ($this->request->query('status') != '') {
			$this->request->data['status'] = explode('_', $this->request->query('status'));
			if (!empty($this->request->data['status'])) {
				$query->where(['status IN' => $this->request->data['status']]);
			}
		}
	}

/**
 * 用户组详细
 *
 * @param int $id 用户组ID
 * @return void
 */
	public function view($id = null) {
		$this->_subTitle = '用户组详细';
		$this->__initGroupCheck($id);
		$this->loadModel('Groups');
		$group = $this->Groups->get($id, ['contain' => false]);
		// 用户组权限取得
		$this->loadModel('GroupAccesses');
		$access = $this->GroupAccesses->getGroupAccessNodeIdList($id);
		// 设置菜单节点
		$this->__setMenuNodes();
		$this->set(compact('group', 'access'));
	}

/**
 * 创建用户组
 *
 * @return void
 */
	public function add() {
		$this->_subTitle = '创建用户组';
		$this->loadModel('Groups');
		$group = $this->Groups->newEntity($this->request->data());
		if ($this->request->is('post')) {
			if ($this->Groups->save($group)) {
				$this->Flash->success('数据保存成功！');
				return $this->redirect(['action' => 'index']);
			} else {
				$this->Flash->error('数据保存失败！');
			}
		}
		$this->set(compact('group'));
	}

/**
 * 用户组编辑
 *
 * @param string $id 用户组ID
 * @return void
 */
	public function edit($id = null) {
		$this->_subTitle = '用户组编辑';
		$this->__initGroupCheck($id);
		$this->loadModel('Groups');
		$group = $this->Groups->get($id, ['contain' => false]);
		if ($this->request->is(['post', 'put'])) {
			$group = $this->Groups->patchEntity($group, $this->request->data());
			if ($this->Groups->save($group)) {
				$this->Flash->success('数据保存成功！');
				return $this->redirect(['action' => 'index']);
			} else {
				$this->Flash->error('数据保存失败！');
			}
		}
		$this->set(compact('group'));
	}

/**
 * 删除用户组
 *
 * @param int $id 用户组ID
 * @return void
 */
	public function delete($id = null) {
		$this->request->allowMethod('post', 'delete');
		$this->__initGroupCheck($id);
		$this->loadModel('Groups');
		$group = $this->Groups->get($id, ['contain' => false]);
		if ($this->Groups->delete($group)) {
			$this->Flash->success('数据删除成功！');
		} else {
			$this->Flash->error('数据删除失败！');
		}
		return $this->redirect(['action' => 'index']);
	}

/**
 * 访问权限
 *
 * @param int $id 用户组ID
 * @return void
 */
	public function access($id = null) {
		$this->_subTitle = '访问权限';
		$this->__initGroupCheck($id);
		$this->loadModel('Groups');
		$group = $this->Groups->get($id, ['contain' => false]);
		$this->loadModel('GroupAccesses');
		// 数据保存
		if ($this->request->is(['post', 'put'])) {
			// 选择的权限节点
			$access = $this->request->data('menu_node_id') ? $this->request->data('menu_node_id') : [];
			$query = $this->GroupAccesses->query();
			// 开启事务保存数据
			$result = $this->GroupAccesses->connection()->transactional(
				function () use ($query, $access, $id) {
					// 删除原有权限节点
					if ($query->delete()->where(['group_id' => $id])->execute()) {
						if (!empty($access)) {
							$query->insert(['group_id', 'menu_node_id']);
							foreach ($access as $key => $val) {
								$query->values(['group_id' => $id, 'menu_node_id' => $val]);
							}
							if (!$query->execute()) {
								return false;
							}
						}
						return true;
					}
					return false;
				}
			);
			if ($result) {
				$this->Flash->success('数据保存成功！');
			} else {
				$this->Flash->error('数据保存失败！');
			}

		} else {
			// 用户组权限取得
			$access = $this->GroupAccesses->getGroupAccessNodeIdList($id);
		}
		// 设置菜单节点
		$this->__setMenuNodes();
		$this->set(compact('group', 'access'));
	}

/**
 * 状态变更
 *
 * @param string $status 状态
 * @param int $id 用户组ID
 * @return void
 */
	public function active($status = 'enable', $id = null) {
		$this->autoRender = false;
		$this->__initGroupCheck($id);
		if (empty($id)) {
			$this->Flash->error('参数错误！');
		} else {
			$ids = explode('_', $id);
			$this->loadModel('Groups');
			$query = $this->Groups->query();
			$result = $query->update()
				->set([
					'status' => $status == 'enable',
					'modified' => new DateTime('now'),
					'modified_by' => $this->request->session()->read('Auth.User.id')
				])
				->where(['id' => $id])
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
 * 系统创始人用户组判断
 *
 * @param int $id 用户组ID
 * @return void
 */
	private function __initGroupCheck($id) {
		if ($id == INIT_GROUP_ID || empty($id)) {
			$this->Flash->error('请求参数错误！');
			return $this->redirect(['action' => 'index']);
		}
	}

/**
 * 设置菜单节点
 *
 * @return void
 */
	private function __setMenuNodes() {
		// 系统菜单节点取得
		$this->loadModel('Menus');
		$menuNodes = $this->Menus->getMenuNodes();
		$pulginMenuNodes = $this->Menus->getMenuNodes(true);
		$this->set(compact('menuNodes', 'pulginMenuNodes'));
	}
}

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
use App\Error\Exception\DataNotFoundException;
use Cake\Core\Configure;
use Cake\Network\Exception\NotFoundException;
use Cake\ORM\TableRegistry;

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
		$groupsTable = TableRegistry::get('Groups');
		$query = $groupsTable->find()->select(['id', 'name', 'status', 'explain']);
		$this->__markQuery($query);
		$this->paginate = array_merge($this->paginate, ['sortWhitelist' => ['id', 'status']]);
		try {
			$this->set('groups', $this->paginate($query));
		} catch (NotFoundException $e) {
			return $this->redirect(['action' => 'index']);
		}
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
			$query->where(['name LIKE' => '%' . $this->request->data('name') . '%']);
		}
		if ($this->request->query('status') != '') {
			$this->request->data['status'] = explode('_', $this->request->query('status'));
			$query->where(['status IN' => $this->request->data('status')]);
		}
	}

/**
 * 添加用户组
 *
 * @return void
 */
	public function add() {
		$groupsTable = TableRegistry::get('Groups');
		$group = $groupsTable->newEntity($this->request->data);
		if ($this->request->is('post')) {
			if ($groupsTable->save($group)) {
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
 * @throws App\Error\Exception\DataNotFoundException
 */
	public function edit($id = null) {
		$this->_subTitle = '用户组编辑';
		if ($id == Configure::read('Init.group_id') || empty($id)) {
			$this->Flash->error('参数错误！');
			return $this->redirect(['action' => 'index']);
		}
		$groupsTable = TableRegistry::get('Groups');
		$group = $groupsTable->find()->where(['id' => $id])->first();
		if (!$group) {
			throw new DataNotFoundException('数据不存在！');
		}
		if ($this->request->is(['post', 'put'])) {
			$group = $groupsTable->patchEntity($group, $this->request->data);
			if ($groupsTable->save($group)) {
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
 * @throws App\Error\Exception\DataNotFoundException
 */
	public function delete($id = null) {
		if (empty($id)) {
			$this->Flash->error('参数错误！');
			return $this->redirect(['action' => 'index']);
		}
		$groupsTable = TableRegistry::get('Groups');
		$group = $groupsTable->find()->where(['id' => $id])->first();
		if (!$group) {
			throw new DataNotFoundException('数据不存在！');
		}
		$this->request->allowMethod('post', 'delete');
		if ($groupsTable->delete($group)) {
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
 * @throws App\Error\Exception\DataNotFoundException
 */
	public function access($id = null) {
		$this->_subTitle = '访问权限';
		if ($id == Configure::read('Init.group_id') || empty($id)) {
			$this->Flash->error('参数错误！');
			return $this->redirect(['action' => 'index']);
		}
		$groupsTable = TableRegistry::get('Groups');
		$group = $groupsTable->find()->where(['id' => $id])->first();
		if (!$group) {
			throw new DataNotFoundException('数据不存在！');
		}
		if ($this->request->is(['post', 'put'])) {
		}
		$this->set(compact('group'));
	}
}

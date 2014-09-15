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
			$query->where(['name LIKE' => '%' . $this->request->data('name') . '%']);
		}
		if ($this->request->query('status') != '') {
			$this->request->data['status'] = explode('_', $this->request->query('status'));
			$query->where(['status IN' => $this->request->data('status')]);
		}
	}

/**
 * 查看用户组
 *
 * @param string $id 用户组ID
 * @return void
 * @throws NotFoundException
 */
	public function view($id = null) {
		$group = $this->Groups->get($id, [
			'contain' => []
		]);
		$this->set('group', $group);
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
				$this->Flash->success('The group has been saved.');
				return $this->redirect(['action' => 'index']);
			} else {
				$this->Flash->error('The group could not be saved. Please, try again.');
			}
		}
		$this->set(compact('group'));
	}

/**
 * 编辑用户组
 *
 * @param string $id 用户组ID
 * @return void
 * @throws NotFoundException
 */
	public function edit($id = null) {
		$group = $this->Groups->get($id, [
			'contain' => []
		]);
		if ($this->request->is(['post', 'put'])) {
			$group = $this->Groups->patchEntity($group, $this->request->data);
			if ($this->Groups->save($group)) {
				$this->Flash->success('The group has been saved.');
				return $this->redirect(['action' => 'index']);
			} else {
				$this->Flash->error('The group could not be saved. Please, try again.');
			}
		}
		$this->set(compact('group'));
	}

/**
 * 删除用户组
 *
 * @param string $id 用户组ID
 * @return void
 * @throws NotFoundException
 */
	public function delete($id = null) {
		$group = $this->Groups->get($id);
		$this->request->allowMethod('post', 'delete');
		if ($this->Groups->delete($group)) {
			$this->Flash->success('The group has been deleted.');
		} else {
			$this->Flash->error('The group could not be deleted. Please, try again.');
		}
		return $this->redirect(['action' => 'index']);
	}
}

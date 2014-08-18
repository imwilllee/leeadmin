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

class GroupsController extends AppAdminController {

/**
 * 用户组一览
 *
 * @return void
 */
	public function index() {
		$this->set('groups', $this->paginate($this->Groups));
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
		$group = $this->Groups->newEntity($this->request->data);
		if ($this->request->is('post')) {
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

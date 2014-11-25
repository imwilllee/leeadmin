<?php
/**
 * 留言管理控制器
 *
 * @copyright LeeAdmin
 * @license   MIT License (http://www.opensource.org/licenses/mit-license.php)
 * @author    Will.Lee <im.will.lee@gmail.com>
 * @package   App.Controller.Admin
 */
namespace App\Controller\Admin;

use App\Controller\AppAdminController;
use DateTime;

class ContactsController extends AppAdminController {

/**
 * 主标题
 *
 * @var string
 */
	protected $_mainTitle = '留言管理';

/**
 * 留言一览
 *
 * @return void
 */
	public function index() {
		$this->_subTitle = '留言一览';
		$this->loadModel('Contacts');
		$query = $this->Contacts->find()->select([
				'Contacts.id',
				'Contacts.name',
				'Contacts.mobile',
				'Contacts.email',
				'Contacts.type_id',
				'Contacts.subject',
				'Contacts.notify_flg',
				'Contacts.created'
			]);
		$this->__markQuery($query);
		$config = [
			'sortWhitelist' => [
				'Contacts.notify_flg',
				'Contacts.created'
			]
		];
		$this->paginate = array_merge($this->paginate, $config);
		$contacts = $this->paginate($query);
		$this->set(compact('contacts'));
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
				$this->request->query['q'] = urlencode($this->request->data('q'));
			}
			if ($this->request->data('email') != '') {
				$this->request->query['email'] = $this->request->data('email');
			}
			if ($this->request->data('mobile') != '') {
				$this->request->query['mobile'] = $this->request->data('mobile');
			}
			if ($this->request->data('notify_flg') != '') {
				$this->request->query['notify_flg'] = implode('_', $this->request->data('notify_flg'));
			}
			if ($this->request->data('type_id') != '') {
				$this->request->query['type_id'] = implode('_', $this->request->data('type_id'));
			}
			if ($this->request->data('start_date') != '') {
				$this->request->query['start_date'] = urlencode($this->request->data('start_date'));
			}
			if ($this->request->data('end_date') != '') {
				$this->request->query['end_date'] = urlencode($this->request->data('end_date'));
			}
		}

		if ($this->request->query('q') != '') {
			$this->request->data['q'] = urldecode($this->request->query('q'));
			$query->andWhere(function ($exp) {
				return $exp->or_([
					'Contacts.name LIKE' => '%' . $this->request->data['q'] . '%',
					'Contacts.subject LIKE' => '%' . $this->request->data['q'] . '%'
				]);
			});
		}
		if ($this->request->query('email') != '') {
			$this->request->data['email'] = $this->request->query('email');
			$query->where(['Contacts.email' => $this->request->data['email']]);
		}
		if ($this->request->query('mobile') != '') {
			$this->request->data['mobile'] = $this->request->query('mobile');
			$query->where(['Contacts.mobile' => $this->request->data['mobile']]);
		}
		if ($this->request->query('notify_flg') != '') {
			$this->request->data['notify_flg'] = explode('_', $this->request->query('notify_flg'));
			if (!empty($this->request->data['notify_flg'])) {
				$query->where(['Contacts.notify_flg IN' => $this->request->data['notify_flg']]);
			}
		}
		if ($this->request->query('type_id') != '') {
			$this->request->data['type_id'] = explode('_', $this->request->query('type_id'));
			if (!empty($this->request->data['type_id'])) {
				$query->where(['Contacts.type_id IN' => $this->request->data['type_id']]);
			}
		}
		if ($this->request->query('start_date') != '') {
			$this->request->data['start_date'] = urldecode($this->request->query('start_date'));
			$query->andWhere(function ($exp) {
				return $exp->gte('Contacts.created', $this->request->data['start_date']);
			});
		}
		if ($this->request->query('end_date') != '') {
			$this->request->data['end_date'] = urldecode($this->request->query('end_date'));
			$query->andWhere(function ($exp) {
				return $exp->lte('Contacts.created', $this->request->data['end_date']);
			});
		}
		if (!$this->request->query('sort')) {
			$query->order(['Contacts.created' => 'DESC']);
		}
	}

/**
 * 状态更新
 *
 * @param string $action 操作名
 * @return void
 */
	public function attribute($action = null) {
		$this->autoRender = false;
		$ids = $this->request->query('id');
		if (empty($ids)) {
			$this->Flash->error('请至少选择一个项目！');
		} else {
			$ids = explode('_', $ids);
			$update = [
				'modified' => new DateTime('now'),
				'modified_by' => $this->request->session()->read('Auth.User.id')
			];
			switch ($action) {
				case 'read':
					$update['notify_flg'] = true;
					break;
				case 'unread':
					$update['notify_flg'] = false;
					break;
				default:
					break;
			}
			$this->loadModel('Contacts');
			$query = $this->Contacts->query();
			$result = $query->update()->set($update)->where(['id IN' => $ids])->execute();
			if ($result) {
				$this->Flash->success('数据更新成功！');
			} else {
				$this->Flash->error('数据更新失败');
			}
		}
		return $this->redirect(['action' => 'index']);
	}

/**
 * 留言详细
 *
 * @param int $id 留言ID
 * @return void
 */
	public function view($id = null) {
		$this->_subTitle = '留言详细';
		$this->loadModel('Contacts');
		$contact = $this->Contacts->get($id, ['contain' => false]);
		if (!$contact->notify_flg) {
			$contact = $this->Contacts->patchEntity($contact, ['notify_flg' => true]);
			$this->Contacts->save($contact, ['validate' => false]);
		}
		$this->set(compact('contact'));
	}

/**
 * 删除留言
 *
 * @param int $id 留言ID
 * @return void
 */
	public function delete($id = null) {
		$this->request->allowMethod('post', 'delete');
		$this->loadModel('Contacts');
		$contact = $this->Contacts->get($id, ['contain' => false]);
		if ($this->Contacts->delete($contact)) {
			$this->Flash->success('数据删除成功！');
		} else {
			$this->Flash->error('数据删除失败！');
		}
		return $this->redirect(['action' => 'index']);
	}
}

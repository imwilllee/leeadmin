<?php
/**
 * 栏目管理控制器
 *
 * @copyright LeeAdmin
 * @license   MIT License (http://www.opensource.org/licenses/mit-license.php)
 * @author    Will.Lee <im.will.lee@gmail.com>
 * @package   App.Controller.Admin
 */
namespace App\Controller\Admin;

use App\Controller\AppAdminController;
use Cake\Core\Configure;
use Cake\ORM\Exception\RecordNotFoundException;

class ChannelsController extends AppAdminController {

/**
 * 主标题
 *
 * @var string
 */
	protected $_mainTitle = '栏目管理';

/**
 * 栏目一览
 *
 * @return void
 */
	public function index() {
		$this->_subTitle = '栏目一览';
		$this->loadModel('Channels');
		try {
			$channels = $this->Channels->find('children', ['for' => 1])
				->select(['id', 'parent_id', 'name', 'channel_code', 'level', 'is_core', 'display_flg', 'article_count']);
			$this->set(compact('channels'));
		} catch (RecordNotFoundException $e) {
			if ($this->_initChannel()) {
				$this->Flash->success('初始化栏目成功！');
			} else {
				$this->Flash->error('初始化栏目失败！');
			}
			return $this->redirect(['action' => 'index']);
		}
	}

/**
 * 添加栏目
 *
 * @param int $id 栏目id
 * @return void
 */
	public function add($id = null) {
		$this->_subTitle = '添加栏目';
		$this->loadModel('Channels');
		$parentChannel = false;
		if ($this->request->is('post')) {
			$parentChannel = $this->Channels->get($this->request->data('parent_id'));
			$channel = $this->Channels->newEntity($this->request->data());
			if ($parentChannel && $parentChannel->id > 1) {
				$channel->set('level', $parentChannel->level + 1);
			}
			if ($this->Channels->save($channel)) {
				$this->Flash->success('数据保存成功！');
				return $this->redirect(['action' => 'index']);
			} else {
				$this->Flash->error('数据保存失败！');
			}
		} else {
			$channel = $this->Channels->newEntity();
			if ($id) {
				$channel->set('parent_id', $id);
			}
		}
		$parentChannelList = $this->Channels->find('treeList');
		$this->set(compact('channel', 'parentChannelList'));
	}

/**
 * 栏目编辑
 *
 * @param int $id 栏目id
 * @return void
 */
	public function edit($id = null) {
		$this->_subTitle = '栏目编辑';
		$this->loadModel('Channels');
		$channel = $this->Channels->get($id);
		if ($this->request->is(['post', 'put'])) {
			$channelParentId = $channel->parent_id;
			$channel = $this->Channels->patchEntity($channel, $this->request->data());
			if ($channelParentId != $this->request->data('parent_id')) {
				$parentChannel = $this->Channels->get($channelParentId);
				if ($parentChannel->id > 1) {
					$channel->set('level', $parentChannel->level + 1);
				}
			}
			if ($this->Channels->save($channel)) {
				$this->Flash->success('数据保存成功！');
				return $this->redirect(['action' => 'index']);
			} else {
				$this->Flash->error('数据保存失败！');
			}
		}
		$parentChannelList = $this->Channels->find('treeList');
		$this->set(compact('channel', 'parentChannelList'));
	}

/**
 * 栏目删除
 *
 * @param int $id 栏目id
 * @return void
 */
	public function delete($id = null) {
		$this->request->allowMethod('post', 'delete');
		$this->loadModel('Channels');
		$channel = $this->Channels->get($id);
		if (!$channel->is_core) {
			if ($this->Channels->delete($channel)) {
				$this->Flash->success('栏目删除成功！');
			} else {
				$this->Flash->error('栏目删除失败！');
			}
		} else {
			$this->Flash->error('不能删除核心栏目！');
		}
		return $this->redirect(['action' => 'index']);
	}

/**
 * 栏目排序
 *
 * @param int $id 栏目id
 * @param string $action 动作
 * @return void
 */
	public function rank($id = null, $action = 'up') {
		$this->loadModel('Channels');
		$channel = $this->Channels->get($id);
		if ($action === 'up') {
			$this->Channels->moveUp($channel);
		} else {
			$this->Channels->moveDown($channel);
		}
		$this->Flash->success('排序成功！');
		return $this->redirect(['action' => 'index']);
	}

/**
 * 初始化栏目
 *
 * @return boolean
 */
	protected function _initChannel() {
		$channel = $this->Channels->newEntity(['name' => '顶级栏目']);
		return $this->Channels->save($channel, ['validate' => false]);
	}
}

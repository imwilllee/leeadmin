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
		$channels = [];
		$this->set(compact('channels'));
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
		if ($id) {
			$this->Channels->get($id);
			$this->request->data['parent_id'] = $id;
		}
		$channel = $this->Channels->newEntity($this->request->data());
		if ($this->request->is('post')) {
			if ($this->Channels->save($channel)) {
				$this->Flash->success('数据保存成功！');
				return $this->redirect(['action' => 'index']);
			} else {
				$this->Flash->error('数据保存失败！');
			}
		}
		$this->set(compact('channel', 'id'));
	}

/**
 * 栏目编辑
 *
 * @param int $id 栏目id
 * @return void
 */
	public function edit($id = null) {
		$this->_subTitle = '栏目编辑';
	}

/**
 * 栏目删除
 *
 * @param int $id 栏目id
 * @return void
 */
	public function delete($id = null) {
	}

/**
 * 栏目排序
 *
 * @param int $id 栏目id
 * @param string $action 动作
 * @return void
 */
	public function rank($id = null, $action = 'up') {
	}
}

<?php
/**
 * 首页KV图管理控制器
 *
 * @copyright LeeAdmin
 * @license   MIT License (http://www.opensource.org/licenses/mit-license.php)
 * @author    Will.Lee <im.will.lee@gmail.com>
 * @package   App.Controller.Admin
 */
namespace App\Controller\Admin;

use App\Controller\AppAdminController;

class CarouselsController extends AppAdminController {

/**
 * 主标题
 *
 * @var string
 */
	protected $_mainTitle = '首页KV图';

/**
 * KV图一览
 *
 * @return void
 */
	public function index() {
		$this->_subTitle = 'KV图一览';
		$this->loadModel('Carousels');
		$query = $this->Carousels->find()->select([
				'Carousels.id',
				'Carousels.name',
				'Carousels.link',
				'Carousels.src',
				'Carousels.rank',
				'Carousels.created'
			]);
		$config = [
			'sortWhitelist' => [
				'Carousels.rank',
				'Carousels.created'
			]
		];
		$this->paginate = array_merge($this->paginate, $config);
		$carousels = $this->paginate($query);
		$this->set(compact('carousels'));
	}

/**
 * KV图添加/编辑
 *
 * @param int $id KV图ID
 * @return void
 */
	public function edit($id = null) {
		$this->loadModel('Carousels');
		if (!$id) {
			$this->_subTitle = 'KV图编辑';
			$carousel = $this->Carousels->newEntity($this->request->data());
		} else {
			$this->_subTitle = 'KV图添加';
			$carousel = $this->Carousels->get($id, ['contain' => false]);
		}
		if ($this->request->is(['post', 'put'])) {
			if ($id) {
				$carousel = $this->Carousels->patchEntity($carousel, $this->request->data());
			}
			if ($this->Carousels->save($carousel)) {
				$this->Flash->success('数据保存成功！');
				return $this->redirect(['action' => 'index']);
			} else {
				$this->Flash->error('数据保存失败！');
			}
		}
		$this->set(compact('carousel'));
	}
/**
 * 删除KV图
 *
 * @param int $id KV图ID
 * @return void
 */
	public function delete($id = null) {
		$this->request->allowMethod('post', 'delete');
		$this->loadModel('Carousels');
		$carousel = $this->Carousels->get($id, ['contain' => false]);
		if ($this->Carousels->delete($carousel)) {
			$this->Flash->success('数据删除成功！');
		} else {
			$this->Flash->error('数据删除失败！');
		}
		return $this->redirect(['action' => 'index']);
	}
}

<?php
/**
 * 插件管理控制器
 *
 * @copyright LeeAdmin
 * @license   MIT License (http://www.opensource.org/licenses/mit-license.php)
 * @author    Will.Lee <im.will.lee@gmail.com>
 * @package   App.Controller.Admin
 */
namespace App\Controller\Admin;

use App\Controller\AppAdminController;
use Cake\ORM\TableRegistry;
use DateTime;

class PluginsController extends AppAdminController {

/**
 * 组件
 * 
 * @var array
 */
	public $components = ['Plugin'];

/**
 * 主标题
 * 
 * @var string
 */
	protected $_mainTitle = '插件管理';

/**
 * 插件一览
 * 
 * @return void
 */
	public function index() {
		$this->_subTitle = '插件一览';
		$pluginsTable = TableRegistry::get('Plugins');
		$query = $pluginsTable->find()->select(['id', 'plugin_code', 'name', 'status', 'version', 'developer']);
		$this->__markQuery($query);
		$this->paginate = array_merge($this->paginate, ['sortWhitelist' => ['id', 'status']]);
		try {
			$this->set('plugins', $this->paginate($query));
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
 * 插件安装
 *
 * @param string $pluginCode 插件代码
 * @return void
 */
	public function install($pluginCode = null) {
		$this->_subTitle = '插件安装';
		if (!empty($pluginCode)) {
			if ($this->Plugin->install($pluginCode)) {
				$this->Flash->success('插件安装成功！');
				return $this->redirect(['action' => 'index']);
			}
		}
		$plugins = $this->Plugin->getNotInstalledPlugins();
		$this->set(compact('plugins'));
	}

/**
 * 状态变更
 * 
 * @param string $action 状态
 * @param int $id 插件ID
 * @return void
 */
	public function active($action = 'enable', $id = null) {
		$this->autoRender = false;
		$pluginsTable = TableRegistry::get('Plugins');
		$plugin = $pluginsTable->get($id, ['contain' => false]);
		$plugin = $pluginsTable->patchEntity($plugin, ['status' => $action == 'enable']);
		$menusTable = TableRegistry::get('Menus');
		$result = $pluginsTable->connection()->transactional(function() use($pluginsTable, $menusTable, $plugin) {
			if ($pluginsTable->save($plugin)) {
				$query = $menusTable->query();
				$result = $query->update()
				->set([
					'status' => $plugin->status,
					'modified' => new DateTime('now'),
					'modified_by' => $this->request->session()->read('Auth.User.id')
				])
				->where(['plugin_code' => $plugin->plugin_code]);
				return $query->execute();
			}
			return false;
		});
		if ($result) {
			$pluginsTable->initPluginConfig();
			$menusTable->clearMenuCache();
			$this->Flash->success('数据更新成功！');
		} else {
			$this->Flash->error('数据更新失败！');
		}
		return $this->redirect(['action' => 'index']);
	}
}

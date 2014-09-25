<?php
/**
 * 插件表
 *
 * @copyright LeeAdmin
 * @license   MIT License (http://www.opensource.org/licenses/mit-license.php)
 * @author    Will.Lee <im.will.lee@gmail.com>
 * @package   App.Model.Table
 */
namespace App\Model\Table;

use App\Model\Table\AppTable;
use Cake\Core\Configure;
use Cake\ORM\TableRegistry;

class PluginsTable extends AppTable {

/**
 * 初始化方法
 *
 * @param array $config 配置项
 * @return void
 */
	public function initialize(array $config) {
		$this->table('plugins');
		$this->primaryKey('id');
		parent::initialize($config);
	}

/**
 * 安装注册新插件
 *
 * @param string $pluginCode 插件代码
 * @param array $plugin 插件信息
 * @return boolean
 */
	public function register($pluginCode, $plugin) {
		return $this->connection()->transactional(function() use($pluginCode, $plugin) {
			$plugin['basic']['plugin_code'] = $pluginCode;
			$plugin['basic']['require'] = implode(',', $plugin['basic']['require']);

			$entity = $this->newEntity($plugin['basic']);
			if (!$this->save($entity)) {
				return false;
			}
			$menusTable = TableRegistry::get('Menus');
			foreach ($plugin['menus'] as $menu) {
				// 存在子节点
				if (isset($menu['menu_nodes'])) {
					$menu['has_nodes'] = true;
				}
				$menu['status'] = false;
				$menu['plugin_code'] = $pluginCode;
				$entity = $menusTable->newEntity($menu);
				if (!$menusTable->save($entity, ['associated' => ['MenuNodes']])) {
					return false;
				}
			}
			$menusTable->clearMenuCache();
			$this->initPluginConfig();
			return true;
		});
	}

/**
 * 初始化插件配置文件
 * 
 * @return void
 */
	public function initPluginConfig() {
		$query = $this->find()
					->select(['plugin_code', 'status', 'autoload', 'bootstrap', 'routes'])
					->where(function($exp){
						return $exp->isNotNull('plugin_code');
					});
		$pluginConfig = [];
		foreach ($query as $plugin) {
			$pluginConfig['Plugin'][$plugin->plugin_code] = $plugin->toArray();
		}
		$contents = '<?php' . "\n" . '$config = ' . var_export($pluginConfig, true) . ';';
		return file_put_contents(CONFIG . 'plugins.php', $contents);
	}
}

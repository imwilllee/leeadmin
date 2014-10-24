<?php
/**
 * 菜单节点管理组件
 *
 * 核心菜单定义在config/menus.php文件内
 * 插件菜单定义在插件目录下的config/menus.php文件内
 * 调用refresh()方法刷新所有菜单
 *
 * @copyright LeeAdmin
 * @license   MIT License (http://www.opensource.org/licenses/mit-license.php)
 * @author    Will.Lee <im.will.lee@gmail.com>
 * @package   App.Controller.Component
 */
namespace App\Controller\Component;

use Cake\Cache\Cache;
use Cake\Controller\Component;
use Cake\Core\App;
use Cake\Core\Plugin;
use Cake\Event\Event;
use Cake\ORM\TableRegistry;

class MenuNodeComponent extends Component {

/**
 * 缓存key
 *
 * @var string
 */
	const MENUS_CACHE_KEY = 'admin_sidebar_menu';

/**
 * 初始化方法
 *
 * @param array $config 配置项
 * @return void
 */
	public function initialize(array $config) {
		parent::initialize($config);
	}

/**
 * 刷新菜单节点
 * 包括核心和插件
 *
 * @return boolean
 */
	public function refreshMenuNodes() {
		$pluginMenuNodes = $this->pluginMenuNodes();
		$menuNodes = include CONFIG . 'menus.php';
		$menuNodes = array_merge($pluginMenuNodes, $menuNodes);
		$menusTable = TableRegistry::get('Menus');
		if ($menusTable->initMenuNodes($menuNodes)) {
			$this->clearCache();
			return true;
		}
		return false;
	}

/**
 * 侧边栏菜单
 *
 * @return array
 */
	public function sidebarMenus() {
		$cache = Cache::read(self::MENUS_CACHE_KEY, 'long');
		if (empty($cache)) {
			$menusTable = TableRegistry::get('Menus');
			$cache = $menusTable->getSidebarMenus();
			Cache::write(self::MENUS_CACHE_KEY, $cache, 'long');
		}
		return $cache;
	}

/**
 * 取得所有插件菜单
 *
 * @return boolean
 */
	public function pluginMenuNodes() {
		// 插件菜单节点
		$pluginMenuNodes = [];
		// 已加载插件列表
		$loadedPlugins = Plugin::loaded();
		if (!empty($loadedPlugins)) {
			$pluginDir = App::path('Plugin');
			foreach ($pluginDir as $dir) {
				foreach ($loadedPlugins as $plugin) {
					// 插件菜单节点定义文件是否存在
					$menuConfigFile = $dir . $plugin . DS . 'config' . DS . 'menus.php';
					if (file_exists($menuConfigFile)) {
						// 读取菜单节点定义
						$menus = include $menuConfigFile;
						if (!empty($menus)) {
							foreach ($menus as $menu) {
								$menu['plugin_code'] = $plugin;
								$pluginMenuNodes[] = $menu;
							}
						}
					}
				}
			}
		}

		return $pluginMenuNodes;
	}

/**
 * 删除缓存
 *
 * @return boolean
 */
	public function clearCache() {
		return Cache::delete(self::MENUS_CACHE_KEY, 'long');
	}
}

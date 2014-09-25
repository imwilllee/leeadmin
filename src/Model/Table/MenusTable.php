<?php
/**
 * 菜单表
 *
 * @copyright LeeAdmin
 * @license   MIT License (http://www.opensource.org/licenses/mit-license.php)
 * @author    Will.Lee <im.will.lee@gmail.com>
 * @package   App.Model.Table
 */
namespace App\Model\Table;

use App\Model\Table\AppTable;
use Cake\Cache\Cache;

class MenusTable extends AppTable {

/**
 * 左侧菜单缓存标志
 */
	const MENUS_CACHE_KEY = 'admin_sidebar_menu';

/**
 * 核心功能菜单
 * link定义格式规则
 * 插件格式:plugin.controller/action 和 plugin.prefix/controller/action
 * 基本格式:controller/action 和 prefix/controller/action
 * 
 * @var array
 */
	protected $_defineCoreMenuNodes = [
		[
			'menu_code' => 'dashboard',
			'parent_code' => null,
			'name' => '控制面板',
			'link' => 'admin/Dashboard/index',
			'class' => 'fa fa-dashboard',
			'rank' => 0,
			'display_flg' => false,
			'menu_nodes' => [
				['link' => 'admin/Dashboard/index', 'name' => '查看']
			]
		],
		[
			'menu_code' => 'plugin',
			'parent_code' => null,
			'name' => '插件管理',
			'link' => 'admin/Plugins/index',
			'class' => 'fa fa-plug',
			'rank' => 0,
			'display_flg' => false,
			'menu_nodes' => [
				['link' => 'admin/Plugins/index', 'name' => '查看'],
				['link' => 'admin/Plugins/install', 'name' => '安装'],
				['link' => 'admin/Plugins/active', 'name' => '状态设置'],
				['link' => 'admin/Plugins/setting', 'name' => '插件设置']
			]
		],
		[
			'menu_code' => 'users',
			'parent_code' => null,
			'name' => '管理员用户组',
			'link' => null,
			'class' => 'fa fa-users',
			'rank' => 0,
			'display_flg' => true
		],
		[
			'menu_code' => null,
			'parent_code' => 'users',
			'name' => '系统管理员',
			'link' => 'admin/Users/index',
			'class' => null,
			'rank' => 0,
			'display_flg' => true,
			'menu_nodes' => [
				['link' => 'admin/Users/add', 'name' => '创建'],
				['link' => 'admin/Users/index', 'name' => '查看'],
				['link' => 'admin/Users/view', 'name' => '详细'],
				['link' => 'admin/Users/edit', 'name' => '编辑'],
				['link' => 'admin/Users/change_status', 'name' => '更改状态'],
				['link' => 'admin/Users/delete', 'name' => '删除']
			]
		],
		[
			'menu_code' => null,
			'parent_code' => 'users',
			'name' => '创建管理员',
			'link' => 'admin/Users/add',
			'class' => null,
			'rank' => 0,
			'display_flg' => true
		],
		[
			'menu_code' => null,
			'parent_code' => 'users',
			'name' => '用户组管理',
			'link' => 'admin/Groups/index',
			'class' => null,
			'rank' => 0,
			'display_flg' => true,
			'menu_nodes' => [
				['link' => 'admin/Groups/add', 'name' => '创建'],
				['link' => 'admin/Groups/index', 'name' => '查看'],
				['link' => 'admin/Groups/view', 'name' => '详细'],
				['link' => 'admin/Groups/edit', 'name' => '编辑'],
				['link' => 'admin/Groups/delete', 'name' => '删除'],
				['link' => 'admin/Groups/access', 'name' => '访问权限'],
			]
		],
		[
			'menu_code' => null,
			'parent_code' => 'users',
			'name' => '创建用户组',
			'link' => 'admin/Groups/add',
			'class' => null,
			'rank' => 0,
			'display_flg' => true
		]
	];

/**
 * 初始化方法
 *
 * @param array $config 配置项
 * @return void
 */
	public function initialize(array $config) {
		$this->table('menus');
		$this->primaryKey('id');
		$this->hasMany('MenuNodes', [
			'className' => 'MenuNodes',
			'foreignKey' => 'menu_id',
			'conditions' => null
		]);
		parent::initialize($config);
	}

/**
 * 管理端侧边栏菜单
 * 
 * @return array
 */
	public function getSidebarMenus() {
		$cache = Cache::read(self::MENUS_CACHE_KEY);
		if (empty($cache)) {
			$query = $this->find()
						->select(['id', 'plugin_code', 'menu_code', 'parent_code', 'name', 'link', 'class'])
						->where(['display_flg' => true, 'status' => true])
						->order(['rank' => 'ASC']);
			foreach ($query as $menu) {
				if ($menu->parent_code === null) {
					$cache[$menu->menu_code] = $menu->toArray();
				} else {
					$cache[$menu->parent_code]['sub_menus'][] = $menu->toArray();
				}
			}
			Cache::write(self::MENUS_CACHE_KEY, $cache);
		}
		return $cache;
	}

/**
 * 刷新核心和插件定义菜单和节点
 * 
 * @return boolean
 */
	public function refreshMenus() {
		return $this->connection()->transactional(function() {
			$this->truncate('menus');
			$this->truncate('menu_nodes');
			foreach ($this->_defineCoreMenuNodes as $menu) {
				// 存在子节点
				if (isset($menu['menu_nodes'])) {
					$menu['has_nodes'] = true;
				}
				$entity = $this->newEntity($menu);
				if (!$this->save($entity, ['associated' => ['MenuNodes']])) {
					return false;
				}
			}
			$this->clearMenuCache();
			return true;
		});
	}

/**
 * 获取菜单以及下属节点
 *
 * @param boolean $plugin 是否为plugin
 * @return Cake\ORM\Query
 */
	public function getMenuNodes($plugin = false) {
		return $this->find()
					->select(['id', 'plugin_code', 'menu_code', 'parent_code', 'name', 'has_nodes'])
					->contain(['MenuNodes'])
					->where(function($exp) use ($plugin){
						$exp->eq('has_nodes', true);
						$exp->eq('status', true);
						if (!$plugin) {
							$exp->isNull('plugin_code');
						} else {
							$exp->isNotNull('plugin_code');
						}
						return $exp;
					})
					->order(['rank' => 'ASC']);
	}

/**
 * 清除菜单缓存
 * 
 * @return void
 */
	public function clearMenuCache() {
		Cache::delete(self::MENUS_CACHE_KEY);
	}
}

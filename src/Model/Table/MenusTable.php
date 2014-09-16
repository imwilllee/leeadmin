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
	protected $_defineCoreMenus = [
		[
			'menu_code' => 'dashboard',
			'parent_code' => null,
			'name' => '控制面板',
			'link' => 'admin/dashboard/index',
			'class' => 'fa fa-dashboard',
			'rank' => 0,
			'display_flg' => true,
			'menu_nodes' => [
				['link' => 'admin/dashboard/index', 'name' => '查看']
			]
		],
		[
			'menu_code' => 'plugin',
			'parent_code' => null,
			'name' => '插件管理',
			'link' => 'admin/plugins/index',
			'class' => 'fa fa-plug',
			'rank' => 0,
			'display_flg' => true,
			'menu_nodes' => [
				['link' => 'admin/plugins/index', 'name' => '查看'],
				['link' => 'admin/plugins/install', 'name' => '安装'],
				['link' => 'admin/plugins/active', 'name' => '状态设置'],
				['link' => 'admin/plugins/setting', 'name' => '插件设置']
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
			'link' => 'admin/users/index',
			'class' => null,
			'rank' => 0,
			'display_flg' => true,
			'menu_nodes' => [
				['link' => 'admin/users/add', 'name' => '创建'],
				['link' => 'admin/users/index', 'name' => '查看'],
				['link' => 'admin/users/view', 'name' => '详细'],
				['link' => 'admin/users/edit', 'name' => '编辑'],
				['link' => 'admin/users/delete', 'name' => '删除']
			]
		],
		[
			'menu_code' => null,
			'parent_code' => 'users',
			'name' => '创建管理员',
			'link' => 'admin/users/add',
			'class' => null,
			'rank' => 0,
			'display_flg' => true
		],
		[
			'menu_code' => null,
			'parent_code' => 'users',
			'name' => '用户组管理',
			'link' => 'admin/groups/index',
			'class' => null,
			'rank' => 0,
			'display_flg' => true,
			'menu_nodes' => [
				['link' => 'admin/groups/add', 'name' => '创建'],
				['link' => 'admin/groups/index', 'name' => '查看'],
				['link' => 'admin/groups/edit', 'name' => '编辑'],
				['link' => 'admin/groups/delete', 'name' => '删除'],
				['link' => 'admin/groups/access', 'name' => '访问权限'],
			]
		],
		[
			'menu_code' => null,
			'parent_code' => 'users',
			'name' => '创建用户组',
			'link' => 'admin/groups/add',
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
				->where(['display_flg' => true])
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
			foreach ($this->_defineCoreMenus as $menu) {
				// 存在子节点
				if (isset($menu['menu_nodes'])) {
					$menu['has_nodes'] = true;
				}
				$entity = $this->newEntity($menu);
				if (!$this->save($entity, ['associated' => ['MenuNodes']])) {
					return false;
				}
			}
			Cache::delete(self::MENUS_CACHE_KEY);
			return true;
		});
	}
}

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
			'menu_code' => 'wechat',
			'parent_code' => null,
			'name' => '微信公众号',
			'link' => null,
			'class' => 'fa fa-wechat',
			'rank' => 0,
			'display_flg' => true
		],
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
		$cache = Cache::read('admin_sidebar_menu');
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
			unset($query);
			Cache::write('admin_sidebar_menu', $cache);
		}
		return $cache;
	}
}

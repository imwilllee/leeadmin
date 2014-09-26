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

class MenusTable extends AppTable {

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
		$sidebars = [];
		$query = $this->find()
					->select(['id', 'plugin_code', 'menu_code', 'parent_code', 'name', 'link', 'class'])
					->where(['display_flg' => true])
					->order(['rank' => 'ASC']);
		foreach ($query as $menu) {
			if ($menu->parent_code === null) {
				if (isset($sidebars[$menu->menu_code])) {
					$sidebars[$menu->menu_code] = array_merge($sidebars[$menu->menu_code], $menu->toArray());
				} else {
					$sidebars[$menu->menu_code] = $menu->toArray();
				}
			} else {
				$sidebars[$menu->parent_code]['sub_menus'][] = $menu->toArray();
			}
		}
		return $sidebars;
	}

/**
 * 初始化菜单节点
 *
 * @param array $menuNodes 菜单节点
 * @return boolean
 */
	public function initMenuNodes($menuNodes) {
		return $this->connection()->transactional(function() use ($menuNodes) {
			$this->truncate('menus');
			$this->truncate('menu_nodes');
			foreach ($menuNodes as $menu) {
				// 存在子节点
				if (isset($menu['menu_nodes'])) {
					$menu['has_nodes'] = true;
				}
				$entity = $this->newEntity($menu);
				if (!$this->save($entity, ['associated' => ['MenuNodes']])) {
					return false;
				}
			}
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
					if (!$plugin) {
						$exp->isNull('plugin_code');
					} else {
						$exp->isNotNull('plugin_code');
					}
					return $exp;
				})
				->order(['rank' => 'ASC']);
	}
}

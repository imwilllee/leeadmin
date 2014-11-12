<?php
/**
 * 分类表
 *
 * @copyright LeeAdmin
 * @license   MIT License (http://www.opensource.org/licenses/mit-license.php)
 * @author    Will.Lee <im.will.lee@gmail.com>
 * @package   App.Model.Table
 */
namespace App\Model\Table;

use App\Model\Table\AppTable;

class CategoriesTable extends AppTable {

/**
 * 初始化方法
 *
 * @param array $config 配置项
 * @return void
 */
	public function initialize(array $config) {
		$this->table('categories');
		$this->primaryKey('id');
		parent::initialize($config);
		$this->addBehavior('Tree');
	}

/**
 * 根据分类代码获取分类信息
 *
 * @param string $categoryCode 分类代码
 * @return boolean
 */
	public function getCategoryByCode($categoryCode = null) {
		if ($categoryCode) {
			$query = $this->find('all')->select(['id'])->where(['category_code' => $categoryCode])->first();
			return $query;
		}
		return false;
	}
}

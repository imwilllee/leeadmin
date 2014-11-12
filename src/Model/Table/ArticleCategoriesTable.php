<?php
/**
 * 文章分类表
 *
 * @copyright LeeAdmin
 * @license   MIT License (http://www.opensource.org/licenses/mit-license.php)
 * @author    Will.Lee <im.will.lee@gmail.com>
 * @package   App.Model.Table
 */
namespace App\Model\Table;

use App\Model\Table\AppTable;

class ArticleCategoriesTable extends AppTable {

/**
 * 初始化方法
 *
 * @param array $config 配置项
 * @return void
 */
	public function initialize(array $config) {
		$this->table('article_categories');
		$this->primaryKey('id');
		parent::initialize($config);
		$this->addBehavior('Tree');
	}
}

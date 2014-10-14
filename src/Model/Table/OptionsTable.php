<?php
/**
 * 系统配置项表
 *
 * @copyright LeeAdmin
 * @license   MIT License (http://www.opensource.org/licenses/mit-license.php)
 * @author    Will.Lee <im.will.lee@gmail.com>
 * @package   App.Model.Table
 */
namespace App\Model\Table;

use App\Model\Table\AppTable;

class OptionsTable extends AppTable {

/**
 * 初始化方法
 *
 * @param array $config 配置项
 * @return void
 */
	public function initialize(array $config) {
		$this->table('options');
		$this->primaryKey('id');
		parent::initialize($config);
	}

/**
 * 保存配置项
 *
 * @param array $options 配置项
 * @return boolean
 */
	public function saveOptions($options) {
	}
}

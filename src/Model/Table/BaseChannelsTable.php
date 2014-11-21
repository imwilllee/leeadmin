<?php
/**
 * 栏目表
 *
 * @copyright LeeAdmin
 * @license   MIT License (http://www.opensource.org/licenses/mit-license.php)
 * @author    Will.Lee <im.will.lee@gmail.com>
 * @package   App.Model.Table
 */
namespace App\Model\Table;

use App\Model\Table\AppTable;
use Cake\Validation\Validator;

class BaseChannelsTable extends AppTable {

/**
 * 初始化方法
 *
 * @param array $config 配置项
 * @return void
 */
	public function initialize(array $config) {
		$this->table('joyweb_channel');
		$this->primaryKey('id');
		parent::initialize($config);
		$this->addBehavior('Tree');
		$this->hasMany('BaseArticles', [
			'className' => 'BaseArticles',
			'foreignKey' => 'channel_id',
			'propertyName' => 'articles'
		]);
	}

	public static function defaultConnectionName() {
		return 'source';
	}
}

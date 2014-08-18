<?php
/**
 * 分组表
 *
 * @copyright LeeAdmin
 * @license   MIT License (http://www.opensource.org/licenses/mit-license.php)
 * @author    Will.Lee <im.will.lee@gmail.com>
 * @package   App.Model.Table
 */
namespace App\Model\Table;

use App\Model\Table\AppTable;
use Cake\Validation\Validator;

class GroupsTable extends AppTable {

/**
 * 初始化方法
 *
 * @param array $config 配置项
 * @return void
 */
	public function initialize(array $config) {
		$this->table('groups');
		$this->primaryKey('id');
		parent::initialize($config);
	}

/**
 * 默认验证规则
 *
 * @param \Cake\Validation\Validator $validator 验证对象
 * @return \Cake\Validation\Validator
 */
	public function validationDefault(Validator $validator) {
		$validator
			->add('id', 'valid', ['rule' => 'numeric'])
			->allowEmpty('id', 'create')
			->validatePresence('name', 'create')
			->notEmpty('name')
			->add('status', 'valid', ['rule' => 'boolean'])
			->allowEmpty('status')
			->allowEmpty('explain')
			->add('created_by', 'valid', ['rule' => 'numeric'])
			->allowEmpty('created_by')
			->add('updated_by', 'valid', ['rule' => 'numeric'])
			->allowEmpty('updated_by');

		return $validator;
	}

}

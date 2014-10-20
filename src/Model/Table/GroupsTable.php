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
		$this->hasMany('GroupAccesses', [
			'className' => 'GroupAccesses',
			'foreignKey' => 'group_id',
			'dependent' => true,
			'cascadeCallbacks' => true,
			'conditions' => null
		]);
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
			->validatePresence('name', 'create', '用户组名称项目不存在！')
			->notEmpty('name', '用户组名称必须填写！')
			->add('name', [
				'maxLength' => [
					'rule' => ['maxLength', 25],
					'message' => '用户组名称超出长度限制！'
				]
			])
			->validatePresence('status', 'create', '状态项目不存在！')
			->allowEmpty('status')
			->add('status', [
				'boolean' => [
					'rule' => 'boolean',
					'message' => '状态选择错误！'
				]
			])
			->allowEmpty('explain')
			->add('explain', [
				'maxLength' => [
					'rule' => ['maxLength', 250],
					'message' => '备注说明超出长度限制！'
				]
			]);
		return $validator;
	}

/**
 * 获取用户组列表
 *
 * @return array
 */
	public function getGroupList() {
		return $this->find('list', ['idField' => 'id', 'valueField' => 'name'])
					->select(['id', 'name'])->toArray();
	}
}

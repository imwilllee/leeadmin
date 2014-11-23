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
use Cake\Core\Configure;
use Cake\Validation\Validator;

class ChannelsTable extends AppTable {

/**
 * 初始化方法
 *
 * @param array $config 配置项
 * @return void
 */
	public function initialize(array $config) {
		$this->table('channels');
		$this->primaryKey('id');
		parent::initialize($config);
		$this->addBehavior('Tree');
	}

/**
 * 默认验证规则
 *
 * @param \Cake\Validation\Validator $validator 验证对象
 * @return \Cake\Validation\Validator
 */
	public function validationDefault(Validator $validator) {
		$typeList = array_keys(Configure::read('Channels.type_id'));
		$validator
			->validatePresence('parent_id', 'create', '所属栏目项目不存在！')
			->notEmpty('parent_id', '请选择所属栏目！')
			->validatePresence('name', 'create', '栏目名称项目不存在！')
			->notEmpty('name', '栏目名称必须填写！')
			->add('name', [
				'maxLength' => [
					'rule' => ['maxLength', 250],
					'message' => '栏目名称超出长度限制！'
				]
			])
			->validatePresence('channel_code', 'create', '栏目代码项目不存在！')
			->allowEmpty('channel_code')
			->add('channel_code', [
				'custom' => [
					'rule' => function ($value, $context) {
						if (preg_match('/^[\-_0-9a-zA-Z]{1,32}$/i', $value)) {
							return true;
						}
						return false;
					},
					'message' => '栏目代码格式错误！',
					'last' => true
				],
				'unique' => [
					'rule' => 'validateUnique',
					'message' => '栏目代码已存在！',
					'provider' => 'table'
				]
			])
			->validatePresence('type_id', 'create', '栏目类型项目不存在！')
			->notEmpty('type_id', '栏目类型必须填写！')
			->add('type_id', [
				'inList' => [
					'rule' => ['inList', $typeList],
					'message' => '栏目类型选择错误！'
				]
			])
			->validatePresence('display_flg', 'create', '显示栏目项目不存在！')
			->allowEmpty('display_flg')
			->add('display_flg', [
				'boolean' => [
					'rule' => 'boolean',
					'message' => '显示栏目选择错误！'
				]
			])
			->validatePresence('is_core', 'create', '核心栏目项目不存在！')
			->allowEmpty('is_core')
			->add('is_core', [
				'boolean' => [
					'rule' => 'boolean',
					'message' => '核心栏目选择错误！'
				]
			]);
		return $validator;
	}
}

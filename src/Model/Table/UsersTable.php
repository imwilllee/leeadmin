<?php
/**
 * 用户表
 *
 * @copyright LeeAdmin
 * @license   MIT License (http://www.opensource.org/licenses/mit-license.php)
 * @author    Will.Lee <im.will.lee@gmail.com>
 * @package   App.Model.Table
 */
namespace App\Model\Table;

use App\Model\Table\AppTable;
use Cake\Auth\DefaultPasswordHasher;
use Cake\Event\Event;
use Cake\ORM\Entity;
use Cake\Validation\Validator;

class UsersTable extends AppTable {

/**
 * 初始化方法
 *
 * @param array $config 配置项
 * @return void
 */
	public function initialize(array $config) {
		$this->table('users');
		$this->primaryKey('id');
		$this->belongsTo('Groups', [
			'className' => 'Groups',
			'foreignKey' => 'group_id',
			'conditions' => null
		]);
		parent::initialize($config);
	}

/**
 * 数据保存前处理
 * 
 * @param Cake\Event\Event $event 事件对象
 * @param Cake\ORM\Entity $entity 实体对象
 * @param array $options 配置项
 * @return boolean
 */
	public function beforeSave(Event $event, Entity $entity, $options = []) {
		if ($entity->has('password')) {
			$entity->set('password', (new DefaultPasswordHasher)->hash($entity->password));
		}
		return parent::beforeSave($event, $entity, $options);
	}

/**
 * 默认验证规则
 *
 * @param \Cake\Validation\Validator $validator 验证对象
 * @return \Cake\Validation\Validator
 */
	public function validationDefault(Validator $validator) {
		$validator
			->validatePresence('email', 'create', '邮箱项目不存在！')
			->notEmpty('email', '邮箱必须填写！')
			->add('email', [
				'maxLength' => [
					'rule' => ['maxLength', 32],
					'message' => '邮箱超出长度限制！',
					'last' => true
				],
				'email' => [
					'rule' => 'email',
					'message' => '邮箱格式错误！',
					'last' => true
				],
				'unique' => [
					'rule' => 'validateUnique',
					'message' => '该邮箱已存在！',
					'provider' => 'table'
				]
			])
			->validatePresence('password', 'create', '密码项目不存在！')
			->notEmpty('password', '密码必须填写！')
			->add('password', [
				'custom' => [
					'rule' => function ($value, $context) {
						if (preg_match("/^[_0-9a-zA-Z]{6,18}$/i", $value)) {
							return true;
						}
						return false;
					},
					'message' => '密码格式错误！',
					'last' => true
				]
			])
			->validatePresence('confirm_password', 'create', '确认密码项目不存在！')
			->notEmpty('confirm_password', '确认密码必须填写！')
			->add('confirm_password', [
				'confirm' => [
					'rule' => function ($value, $context) {
						return $value === $context['data']['password'];
					},
					'message' => '两次密码输入不一致！',
					'last' => true
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
}

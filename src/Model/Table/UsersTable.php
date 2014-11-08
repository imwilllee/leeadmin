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
use Cake\Core\Configure;
use Cake\Event\Event;
use Cake\ORM\Entity;
use Cake\ORM\TableRegistry;
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
		if ($entity->has('user_password')) {
			$entity->set('password', $entity->user_password);
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
		$groupsTable = TableRegistry::get('Groups');
		$groupList = array_keys($groupsTable->getGroupList());
		$sexList = array_keys(Configure::read('Common.sex'));
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
			->validatePresence('user_password', 'create', '密码项目不存在！')
			->notEmpty('user_password', '密码必须填写！')
			->add('user_password', [
				'custom' => [
					'rule' => function ($value, $context) {
						if (preg_match('/^[_0-9a-zA-Z]{6,18}$/i', $value)) {
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
						return $value === $context['data']['user_password'];
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
			->validatePresence('group_id', 'create', '所属用户组项目不存在！')
			->notEmpty('group_id', '所属用户组必须填写！')
			->add('group_id', [
				'inList' => [
					'rule' => ['inList', $groupList],
					'message' => '所属用户组选择错误！'
				]
			])
			->validatePresence('alias', 'create', '昵称项目不存在！')
			->notEmpty('alias', '昵称必须填写！')
			->add('alias', [
				'maxLength' => [
					'rule' => ['maxLength', 12],
					'message' => '昵称超出长度限制！',
					'last' => true
				]
			])
			->allowEmpty('mobile')
			->add('mobile', [
				'custom' => [
					'rule' => function ($value, $context) {
						if (preg_match('/^[0-9]{11,13}$/i', $value)) {
							return true;
						}
						return false;
					},
					'message' => '手机号码格式错误！'
				]
			])
			->allowEmpty('birth')
			->add('birth', [
				'date' => [
					'rule' => 'date',
					'message' => '出生年月格式错误！'
				]
			])
			->allowEmpty('sex')
			->add('sex', [
				'inList' => [
					'rule' => ['inList', $sexList],
					'message' => '性别选择错误！'
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
 * 密码修改验证规则
 *
 * @param \Cake\Validation\Validator $validator 验证对象
 * @return \Cake\Validation\Validator
 */
	public function validationChangePassword(Validator $validator) {
		$validator
			->validatePresence('id', true, '用户ID项目不存在！')
			->notEmpty('id', '用户ID不能为空！')
			->validatePresence('old_password', true, '原始密码项目不存在！')
			->notEmpty('old_password', '原始密码必须填写！')
			->add('old_password', [
				'custom' => [
					'rule' => function ($value, $context) {
						return (new DefaultPasswordHasher)->check($value, $context['data']['password']);
					},
					'message' => '原始密码不正确！',
					'last' => true
				]
			])
			->validatePresence('user_password', true, '密码项目不存在！')
			->notEmpty('user_password', '密码必须填写！')
			->add('user_password', [
				'custom' => [
					'rule' => function ($value, $context) {
						if (preg_match('/^[_0-9a-zA-Z]{6,18}$/i', $value)) {
							return true;
						}
						return false;
					},
					'message' => '密码格式错误！',
					'last' => true
				]
			])
			->validatePresence('confirm_password', true, '确认密码项目不存在！')
			->notEmpty('confirm_password', '确认密码必须填写！')
			->add('confirm_password', [
				'confirm' => [
					'rule' => function ($value, $context) {
						return $value === $context['data']['user_password'];
					},
					'message' => '两次密码输入不一致！',
					'last' => true
				]
			]);
		return $validator;
	}
}

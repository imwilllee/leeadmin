<?php
/**
 * 留言表
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

class ContactsTable extends AppTable {

/**
 * 初始化方法
 *
 * @param array $config 配置项
 * @return void
 */
	public function initialize(array $config) {
		$this->table('contacts');
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
		$typeList = array_keys(Configure::read('Contacts.type'));
		$validator
			->validatePresence('name', 'create', '您的姓名项目不存在！')
			->notEmpty('name', '您的姓名必须填写！')
			->add('name', [
				'maxLength' => [
					'rule' => ['maxLength', 250],
					'message' => '您的姓名超出长度限制！'
				]
			])
			->validatePresence('mobile', 'create', '电话号码项目不存在！')
			->notEmpty('mobile', '电话号码必须填写！')
			->add('mobile', [
				'maxLength' => [
					'rule' => ['maxLength', 16],
					'message' => '电话号码超出长度限制！'
				]
			])
			->validatePresence('email', 'create', '电子邮箱项目不存在！')
			->notEmpty('email', '电子邮箱必须填写！')
			->add('email', [
				'email' => [
					'rule' => 'email',
					'message' => '电子邮箱格式错误！'
				]
			])
			->validatePresence('type_id', 'create', '资料类型项目不存在！')
			->allowEmpty('type_id')
			->add('type_id', [
				'inList' => [
					'rule' => ['inList', $typeList],
					'message' => '资料类型选择错误！'
				]
			])
			->validatePresence('subject', 'create', '公司名项目不存在！')
			->allowEmpty('subject')
			->add('subject', [
				'maxLength' => [
					'rule' => ['maxLength', 250],
					'message' => '公司名超出长度限制！'
				]
			])
			->validatePresence('content', 'create', '留言内容项目不存在！')
			->notEmpty('content', '留言内容必须填写！')
			->add('content', [
				'maxLength' => [
					'rule' => ['maxLength', 15000],
					'message' => '留言内容超出长度限制！'
				]
			]);
		return $validator;
	}

}

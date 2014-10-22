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
use Cake\Core\Configure;
use Cake\Validation\Validator;

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
 * 站点信息验证规则
 *
 * @param \Cake\Validation\Validator $validator 验证对象
 * @return \Cake\Validation\Validator
 */
	public function validationIndex(Validator $validator) {
		$runStatus = array_keys(Configure::read('Common.run_status'));
		$validator
			->validatePresence('title', 'create', '网站名称项目不存在！')
			->notEmpty('title', '网站名称必须填写！')
			->add('title', [
				'maxLength' => [
					'rule' => ['maxLength', 64],
					'message' => '网站名称超出长度限制！',
					'last' => true
				]
			])
			->validatePresence('title', 'create', '网站域名项目不存在！')
			->allowEmpty('domain')
			->add('domain', [
				'maxLength' => [
					'rule' => ['maxLength', 64],
					'message' => '网站域名超出长度限制！',
					'last' => true
				]
			])
			->validatePresence('email', 'create', '邮箱地址项目不存在！')
			->allowEmpty('email')
			->add('email', [
				'maxLength' => [
					'rule' => ['maxLength', 32],
					'message' => '邮箱地址超出长度限制！',
					'last' => true
				],
				'email' => [
					'rule' => 'email',
					'message' => '邮箱地址格式错误！',
					'last' => true
				]
			])
			->validatePresence('tagline', 'create', '网站简介项目不存在！')
			->allowEmpty('tagline')
			->add('tagline', [
				'maxLength' => [
					'rule' => ['maxLength', 3000],
					'message' => '网站简介超出长度限制！',
					'last' => true
				]
			])
			->validatePresence('icp_no', 'create', 'ICP备案号项目不存在！')
			->allowEmpty('icp_no')
			->add('icp_no', [
				'maxLength' => [
					'rule' => ['maxLength', 32],
					'message' => 'ICP备案号超出长度限制！',
					'last' => true
				]
			])
			->validatePresence('timezone', 'create', '时区设置项目不存在！')
			->allowEmpty('timezone')
			->add('timezone', [
				'maxLength' => [
					'rule' => ['maxLength', 255],
					'message' => '时区设置超出长度限制！',
					'last' => true
				]
			])
			->validatePresence('run_status', 'create', '网站运行状态项目不存在！')
			->notEmpty('run_status', '网站运行状态选择！')
			->add('run_status', [
				'inList' => [
					'rule' => ['inList', $runStatus],
					'message' => '网站运行状态选择错误！'
				]
			])
			->validatePresence('maintenance_info', 'create', '维护信息项目不存在！')
			->allowEmpty('maintenance_info')
			->add('maintenance_info', [
				'maxLength' => [
					'rule' => ['maxLength', 20000],
					'message' => '维护信息超出长度限制！',
					'last' => true
				]
			]);
		return $validator;
	}

/**
 * 保存配置项
 *
 * @param App\Model\Entity\Option $options 配置项
 * @param string $plugin 插件名称
 * @return boolean
 */
	public function saveOptions($options, $plugin = null) {
		return $this->connection()->transactional(function () use ($options, $plugin) {
			foreach ($options->toArray() as $key => $val) {
				if ($key == '_csrfToken' || empty($key)) {
					continue;
				}
				$option = [
					'id' => $key,
					'value' => $val,
					'belongs_plugin' => $plugin
				];
				$entity = $this->newEntity($option);
				if (!$this->save($entity, ['validate' => false])) {
					return false;
				}
			}
			return true;
		});
	}

/**
 * 获取所有的配置项
 *
 * @return App\Model\Entity\Option;
 */
	public function getAllOptions() {
		$query = $this->find();
		$entity = $this->newEntity();
		foreach ($query as $option) {
			$entity->set($option->id, $option->value);
		}
		return $entity;
	}
}

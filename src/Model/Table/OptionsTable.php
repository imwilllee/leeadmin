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
use Cake\Cache\Cache;
use Cake\Core\Configure;
use Cake\Validation\Validator;

class OptionsTable extends AppTable {

/**
 * 缓存key
 *
 * @var string
 */
	const OPTIONS_CACHE_KEY = 'app_options';

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
					'rule' => ['maxLength', 250],
					'message' => '网站名称超出长度限制！',
					'last' => true
				]
			])
			->validatePresence('keywords', 'create', '网站关键字项目不存在！')
			->allowEmpty('keywords')
			->add('keywords', [
				'maxLength' => [
					'rule' => ['maxLength', 250],
					'message' => '网站关键字超出长度限制！',
					'last' => true
				]
			])
			->validatePresence('description', 'create', '网站描述项目不存在！')
			->allowEmpty('description')
			->add('description', [
				'maxLength' => [
					'rule' => ['maxLength', 500],
					'message' => '网站描述超出长度限制！',
					'last' => true
				]
			])
			->validatePresence('icp_no', 'create', 'ICP备案号项目不存在！')
			->allowEmpty('icp_no')
			->add('icp_no', [
				'maxLength' => [
					'rule' => ['maxLength', 250],
					'message' => 'ICP备案号超出长度限制！',
					'last' => true
				]
			])
			->validatePresence('commpany_name', 'create', '公司名称项目不存在！')
			->allowEmpty('commpany_name')
			->add('commpany_name', [
				'maxLength' => [
					'rule' => ['maxLength', 250],
					'message' => '公司名称超出长度限制！',
					'last' => true
				]
			])
			->validatePresence('mobile', 'create', '电话项目不存在！')
			->allowEmpty('mobile')
			->add('mobile', [
				'maxLength' => [
					'rule' => ['maxLength', 250],
					'message' => '电话超出长度限制！',
					'last' => true
				]
			])
			->validatePresence('email', 'create', '电话项目不存在！')
			->allowEmpty('email')
			->add('email', [
				'maxLength' => [
					'rule' => ['maxLength', 250],
					'message' => '电话超出长度限制！',
					'last' => true
				],
				'email' => [
					'rule' => 'email',
					'message' => '邮箱格式错误！',
					'last' => true
				]
			])
			->validatePresence('fax', 'create', '传真项目不存在！')
			->allowEmpty('fax')
			->add('fax', [
				'maxLength' => [
					'rule' => ['maxLength', 250],
					'message' => '传真超出长度限制！',
					'last' => true
				]
			])
			->validatePresence('address', 'create', '地址项目不存在！')
			->allowEmpty('address')
			->add('address', [
				'maxLength' => [
					'rule' => ['maxLength', 250],
					'message' => '地址超出长度限制！',
					'last' => true
				]
			])
			->validatePresence('tagline', 'create', '简短描述目不存在！')
			->allowEmpty('copyright')
			->add('tagline', [
				'maxLength' => [
					'rule' => ['maxLength', 3000],
					'message' => '简短描述超出长度限制！',
					'last' => true
				]
			]);
		return $validator;
	}

/**
 * 保存配置项
 *
 * @param App\Model\Entity\Option $options 配置项
 * @param int $typeId 类别ID
 * @return boolean
 */
	public function saveOptions($options, $typeId = null) {
		return $this->connection()->transactional(function () use ($options, $typeId) {
			foreach ($options->toArray() as $key => $val) {
				if ($key == '_csrfToken' || empty($key)) {
					continue;
				}
				$option = [
					'id' => $key,
					'value' => $val,
					'type_id' => $typeId
				];
				$entity = $this->newEntity($option);
				if (!$this->save($entity, ['validate' => false])) {
					return false;
				}
			}
			$this->clearCache();
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

/**
 * 获取对应分类下配置项
 *
 * @param int $typeId 类别ID
 * @return App\Model\Entity\Option;
 */
	public function getOptionsByTypeId($typeId = null) {
		$query = $this->find()->where(['type_id' => $typeId]);
		$entity = $this->newEntity();
		foreach ($query as $option) {
			$entity->set($option->id, $option->value);
		}
		return $entity;
	}

/**
 * 获取缓存配置项
 * 如果配置项没有写入缓存则写入
 *
 * @return array
 */
	public function getCacheOptions() {
		$cache = Cache::read(self::OPTIONS_CACHE_KEY, 'long');
		if (empty($cache)) {
			$options = $this->getAllOptions();
			if (!empty($options)) {
				$cache = $options->toArray();
				Cache::write(self::OPTIONS_CACHE_KEY, $cache, 'long');
			}
		}
		return $cache;
	}

/**
 * 清除配置项缓存
 *
 * @return boolean
 */
	public function clearCache() {
		return Cache::delete(self::OPTIONS_CACHE_KEY, 'long');
	}
}

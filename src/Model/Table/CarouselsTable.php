<?php
/**
 * KV图表
 *
 * @copyright LeeAdmin
 * @license   MIT License (http://www.opensource.org/licenses/mit-license.php)
 * @author    Will.Lee <im.will.lee@gmail.com>
 * @package   App.Model.Table
 */
namespace App\Model\Table;

use App\Model\Table\AppTable;
use Cake\Validation\Validator;

class CarouselsTable extends AppTable {

/**
 * 初始化方法
 *
 * @param array $config 配置项
 * @return void
 */
	public function initialize(array $config) {
		$this->table('carousels');
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
			->validatePresence('name', 'create', '名称项目不存在！')
			->notEmpty('name', '名称必须填写！')
			->add('name', [
				'maxLength' => [
					'rule' => ['maxLength', 250],
					'message' => '名称超出长度限制！'
				]
			])
			->validatePresence('src', 'create', '图片路径项目不存在！')
			->notEmpty('src', '图片路径必须填写！')
			->add('src', [
				'maxLength' => [
					'rule' => ['maxLength', 250],
					'message' => '图片路径超出长度限制！'
				]
			])
			->validatePresence('rank', 'create', '排序项目不存在！')
			->allowEmpty('rank')
			->add('rank', [
				'custom' => [
					'rule' => function ($value, $context) {
						return preg_match('/^[0-9]+$/', $value) ? true : false;
					},
					'message' => '排序格式错误！',
					'last' => true
				]
			]);
		return $validator;
	}

}

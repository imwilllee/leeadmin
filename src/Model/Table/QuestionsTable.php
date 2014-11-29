<?php
/**
 * 问题表
 *
 * @copyright LeeAdmin
 * @license   MIT License (http://www.opensource.org/licenses/mit-license.php)
 * @author    Will.Lee <im.will.lee@gmail.com>
 * @package   App.Model.Table
 */
namespace App\Model\Table;

use App\Model\Table\AppTable;
use Cake\Validation\Validator;

class QuestionsTable extends AppTable {

/**
 * 初始化方法
 *
 * @param array $config 配置项
 * @return void
 */
	public function initialize(array $config) {
		$this->table('questions');
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
			->validatePresence('category_id', 'create', '所属分类项目不存在！')
			->notEmpty('category_id', '所属分类必须填写！')
			->add('category_id', [
				'custom' => [
					'rule' => function ($value, $context) {
						return preg_match('/^[0-9]+$/', $value) ? true : false;
					},
					'message' => '所属分类格式错误！',
					'last' => true
				]
			])
			->validatePresence('question', 'create', '问题项目不存在！')
			->notEmpty('question', '问题必须填写！')
			->add('question', [
				'maxLength' => [
					'rule' => ['maxLength', 500],
					'message' => '问题超出长度限制！'
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

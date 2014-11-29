<?php
/**
 * 问题分类表
 *
 * @copyright LeeAdmin
 * @license   MIT License (http://www.opensource.org/licenses/mit-license.php)
 * @author    Will.Lee <im.will.lee@gmail.com>
 * @package   App.Model.Table
 */
namespace App\Model\Table;

use App\Model\Table\AppTable;
use Cake\Validation\Validator;

class QuestionCategoriesTable extends AppTable {

/**
 * 初始化方法
 *
 * @param array $config 配置项
 * @return void
 */
	public function initialize(array $config) {
		$this->table('question_categories');
		$this->primaryKey('id');
		$this->hasMany('Questions', [
			'className' => 'Questions',
			'foreignKey' => 'category_id',
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
			->validatePresence('name', 'create', '分类名称项目不存在！')
			->notEmpty('name', '分类名称必须填写！')
			->add('name', [
				'maxLength' => [
					'rule' => ['maxLength', 250],
					'message' => '分类名称超出长度限制！'
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

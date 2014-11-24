<?php
/**
 * 文章表
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

class ArticlesTable extends AppTable {

/**
 * 初始化方法
 *
 * @param array $config 配置项
 * @return void
 */
	public function initialize(array $config) {
		$this->table('articles');
		$this->primaryKey('id');
		$this->belongsTo('Channels', [
			'className' => 'Channels',
			'foreignKey' => 'channel_id',
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
			->validatePresence('title', 'create', '标题项目不存在！')
			->notEmpty('title', '标题不能为空！')
			->add('title', [
				'maxLength' => [
					'rule' => ['maxLength', 250],
					'message' => '标题超出长度限制！'
				]
			])
			// ->validatePresence('arlicle_code', 'create', '文章代码项目不存在！')
			// ->allowEmpty('arlicle_code')
			// ->add('arlicle_code', [
			// 	'custom' => [
			// 		'rule' => function ($value, $context) {
			// 			return preg_match('/^[\-_0-9a-zA-Z]{1,32}$/i', $value);
			// 		},
			// 		'message' => '文章代码格式错误！',
			// 		'last' => true
			// 	],
			// 	'unique' => [
			// 		'rule' => 'validateUnique',
			// 		'message' => '文章代码已存在！',
			// 		'provider' => 'table'
			// 	]
			// ])
			->validatePresence('channel_id', 'create', '所属栏目项目不存在！')
			->notEmpty('channel_id', '所属栏目必须选择！')
			->add('channel_id', [
				'custom' => [
					'rule' => function ($value, $context) {
						return preg_match('/^[0-9]+$/', $value) ? true : false;
					},
					'message' => '所属栏目格式错误！',
					'last' => true
				]
			])
			->validatePresence('rank', 'create', '文章排序项目不存在！')
			->allowEmpty('rank')
			->add('rank', [
				'custom' => [
					'rule' => function ($value, $context) {
						return preg_match('/^[0-9]+$/', $value) ? true : false;
					},
					'message' => '文章排序格式错误！',
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
			->validatePresence('recommend_flg', 'create', '文章属性(推荐)项目不存在！')
			->allowEmpty('recommend_flg')
			->add('recommend_flg', [
				'boolean' => [
					'rule' => 'boolean',
					'message' => '文章属性(推荐)选择错误！'
				]
			])
			->validatePresence('hot_flg', 'create', '文章属性(热门)项目不存在！')
			->allowEmpty('hot_flg')
			->add('hot_flg', [
				'boolean' => [
					'rule' => 'boolean',
					'message' => '文章属性(热门)选择错误！'
				]
			])
			->validatePresence('new_flg', 'create', '文章属性(最新)项目不存在！')
			->allowEmpty('new_flg')
			->add('new_flg', [
				'boolean' => [
					'rule' => 'boolean',
					'message' => '文章属性(最新)选择错误！'
				]
			])
			->validatePresence('is_delete', 'create', '是否允许删除项目不存在！')
			->allowEmpty('is_delete')
			->add('is_delete', [
				'boolean' => [
					'rule' => 'boolean',
					'message' => '是否允许删除选择错误！'
				]
			])
			->validatePresence('thumbnail', 'create', '缩略图路径项目不存在！')
			->allowEmpty('thumbnail')
			->add('thumbnail', [
				'maxLength' => [
					'rule' => ['maxLength', 250],
					'message' => '缩略图路径超出长度限制！'
				]
			]);
		return $validator;
	}
}

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
}

<?php
/**
 * 项目ORM表基础
 *
 * @copyright LeeAdmin
 * @license   MIT License (http://www.opensource.org/licenses/mit-license.php)
 * @author    Will.Lee <im.will.lee@gmail.com>
 * @package   App.Model.Table
 */
namespace App\Model\Table;

use Cake\Core\Configure;
use Cake\Event\Event;
use Cake\ORM\Entity;
use Cake\ORM\Table;

class AppTable extends Table {

/**
 * 初始化方法
 *
 * @param array $config 配置项
 * @return void
 */
	public function initialize(array $config) {
		$this->addBehavior('Timestamp');
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
		// 登录信息
		$user = Configure::read('Auth.User');
		// 登录的状态下
		if (!empty($user)) {
			// 数据创建状态并且表中包含created_by字段
			if ($entity->isNew() !== false && $this->hasField('created_by') && $entity->has('created_by') === false) {
				$entity->set('created_by', $user['id']);
				//$entity->unsetProperty('created_by');
			}
			if ($this->hasField('modified_by') && $entity->has('modified_by') === false) {
				$entity->set('modified_by', $user['id']);
			}
		}
		return true;
	}
}
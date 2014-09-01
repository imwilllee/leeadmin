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
		$user = Configure::read('Auth.User');
		if (!empty($user)) {
			if ($this->hasField('created_by')) {
				$this->patchEntity($entity, ['created_by' => $user['id']]);
			}
			if ($entity->has($this->primaryKey())) {
				if ($this->hasField('updated_by')) {
					$this->patchEntity($entity, ['updated_by' => $user['id']]);
				}
			}
		}
		return true;
	}
}
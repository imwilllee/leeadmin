<?php
/**
 * 项目管理端控制器基础
 *
 * @copyright LeeAdmin
 * @license   MIT License (http://www.opensource.org/licenses/mit-license.php)
 * @author    Will.Lee <im.will.lee@gmail.com>
 * @package   App.Controller
 */
namespace App\Controller;

use App\Controller\AppController;
use Cake\Core\Configure;
use Cake\Event\Event;

class AppAdminController extends AppController {

/**
 * 组件
 * 
 * @var array
 */
	public $components = ['Flash'];

/**
 * 模板助手
 * 
 * @var array
 */
	public $helpers = ['Admin'];

/**
 * 控制器标题
 * 
 * @var string
 */
	protected $_controllerTitle = null;

/**
 * 操作标题
 * 
 * @var string
 */
	protected $_actionTitle = null;

/**
 * 头部标题
 * 
 * @var string
 */
	protected $_headerTitle = null;

/**
 * 控制器操作执行前回调方法
 * 
 * @param Cake\Event\Event $event 事件对象
 * @return void
 */
	public function beforeFilter(Event $event) {
		parent::beforeFilter($event);
		Configure::write('Auth.User.id', 1);
	}

/**
 * 模板渲染前回调方法
 * 
 * @param Cake\Event\Event $event 事件对象
 * @return void
 */
	public function beforeRender(Event $event) {
		parent::beforeRender($event);
		$this->set('controllerTitle', $this->_controllerTitle);
		$this->set('actionTitle', $this->_actionTitle);
		$this->set('headerTitle', $this->_headerTitle);
	}
}

<?php
/**
 * 项目控制器基础
 *
 * @copyright LeeAdmin
 * @license   MIT License (http://www.opensource.org/licenses/mit-license.php)
 * @author    Will.Lee <im.will.lee@gmail.com>
 * @package   App.Controller
 */
namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\Event;

class AppController extends Controller {

/**
 * 视图类
 * 
 * @var string
 */
	public $viewClass = 'App\View\View';

/**
 * 加载组件
 * 
 * @var array
 */
	public $components = ['Flash'];

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
 * 定义模板加载回调方法
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

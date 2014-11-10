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
use Cake\Core\Configure;
use Cake\Event\Event;

class AppController extends Controller {

/**
 * 视图类
 *
 * @var string
 */
	public $viewClass = 'App\View\AppView';

/**
 * 初始化钩子方法
 *
 * @return void
 */
	public function initialize() {
		$this->loadComponent('Flash', ['className' => 'AppFlash']);
		$this->loadComponent('Csrf');
		$this->loadComponent('Security');
	}

/**
 * 控制器操作执行前回调方法
 *
 * @param Cake\Event\Event $event 事件对象
 * @return void
 */
	public function beforeFilter(Event $event) {
		parent::beforeFilter($event);
		// url前缀写入配置 方便其他处调用
		Configure::write('prefix', $this->request->params['prefix']);
	}

/**
 * 模板渲染前回调方法
 *
 * @param Cake\Event\Event $event 事件对象
 * @return void
 */
	public function beforeRender(Event $event) {
		parent::beforeRender($event);
	}
}

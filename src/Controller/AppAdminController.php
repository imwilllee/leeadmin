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
use Cake\ORM\TableRegistry;

class AppAdminController extends AppController {

/**
 * 组件
 * 
 * @var array
 */
	public $components = [
		'Auth' => [
			'authenticate' => [
				'Form' => [
					'userModel' => 'Users',
					'fields' => ['username' => 'email'],
					'contain' => false,
					'passwordHasher' => 'Default'
				],
			],
			'loginAction' => [
				'controller' => 'Users',
				'action' => 'login',
				'prefix' => 'admin'
			],
			'loginRedirect' => [
				'controller' => 'Dashboard',
				'action' => 'index',
				'prefix' => 'admin'
			],
			'flash' => ['element' => 'error'],
			'authError' => '请先登录系统！'
		]
	];

/**
 * 模板助手
 * 
 * @var array
 */
	public $helpers = ['Admin'];

/**
 * 页面主标题
 * 
 * @var string
 */
	protected $_mainTitle = null;

/**
 * 页面副标题
 * 
 * @var string
 */
	protected $_subTitle = null;

/**
 * 控制器操作执行前回调方法
 * 
 * @param Cake\Event\Event $event 事件对象
 * @return void
 */
	public function beforeFilter(Event $event) {
		parent::beforeFilter($event);
		if ($this->Auth->user()) {
			Configure::write('Auth.User.id', $this->request->session()->read('Auth.User.id'));
		}
	}

/**
 * 模板渲染前回调方法
 * 
 * @param Cake\Event\Event $event 事件对象
 * @return void
 */
	public function beforeRender(Event $event) {
		parent::beforeRender($event);
		$this->set('mainTitle', $this->_mainTitle);
		$this->set('subTitle', $this->_subTitle);
		// 登陆后设置左侧菜单
		if ($this->Auth->user()) {
			$menusTable = TableRegistry::get('Menus');
			$this->set('sidebarMenus', $menusTable->getSidebarMenus());
			$sidebarActive = [];
			if (!empty($this->request->cookies['SIDEBAR_ACTIVE'])) {
				$sidebarActive = explode('.', $this->request->cookies['SIDEBAR_ACTIVE']);
			}
			$this->set('sidebarActive', $sidebarActive);
		}
	}
}

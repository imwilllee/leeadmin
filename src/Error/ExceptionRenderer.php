<?php
/**
 * 项目异常模板渲染处理
 *
 * @copyright LeeAdmin
 * @license   MIT License (http://www.opensource.org/licenses/mit-license.php)
 * @author    Will.Lee <im.will.lee@gmail.com>
 * @package   App.Error
 */
namespace App\Error;

use Cake\Core\Configure;
use Cake\Error;
use Cake\ORM\TableRegistry;
use Cake\Utility\Inflector;
use Exception;

class ExceptionRenderer extends Error\ExceptionRenderer {

/**
 * 构造函数
 *
 * @param Exception $exception 异常对象
 */
	public function __construct(Exception $exception) {
		parent::__construct($exception);
		$this->controller->viewClass = 'App\View\AppView';
		$this->controller->layout = 'error';
		$this->_setVariables();
	}

/**
 * 输出异常信息
 *
 * @param string $template 模板
 * @return void
 */
	protected function _outputMessage($template) {
		if (!Configure::read('debug')) {
			$this->controller->viewPath = Inflector::camelize($this->controller->request->params['prefix']) . '/Error';
		}
		return parent::_outputMessage($template);
	}

/**
 * 安全输出异常信息
 *
 * @param string $template 模板
 * @return void
 */
	protected function _outputMessageSafe($template) {
		$this->controller->layoutPath = null;
		$this->controller->subDir = null;
		$this->controller->viewPath = Inflector::camelize($this->controller->request->params['prefix']) . '/Error';
		$this->controller->helpers = ['Form', 'Html', 'Session'];
		$view = $this->controller->createView();
		$this->controller->response->body($view->render($template, 'error'));
		$this->controller->response->type('html');
		return $this->controller->response;
	}

/**
 * 设置变量信息
 *
 * @return void
 */
	protected function _setVariables() {
		$mainTitle = '发生错误';
		$sidebarParentIds = $sidebarMenus = [];
		// 登陆后设置左侧菜单
		if ($this->controller->request->session()->check('Auth.User.id')) {
			$menusTable = TableRegistry::get('Menus');
			$sidebarMenus = $menusTable->getSidebarMenus();
			if (!empty($this->controller->request->cookies['SIDEBAR_PARENT_IDS'])) {
				$sidebarParentIds = explode('.', $this->controller->request->cookies['SIDEBAR_PARENT_IDS']);
			}
		}
		$this->controller->set(compact('mainTitle', 'sidebarParentIds', 'sidebarMenus'));
	}
}

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
use Cake\Utility\Inflector;

class ExceptionRenderer extends Error\ExceptionRenderer {

/**
 * 构造函数
 * 
 * @param Exception $exception 异常对象
 */
	public function __construct(\Exception $exception) {
		parent::__construct($exception);
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
		parent::_outputMessage($template);
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
		$this->controller->layout = 'error';
		$this->controller->helpers = ['Form', 'Html', 'Session'];
		$view = $this->controller->createView();
		$this->controller->response->body($view->render($template, 'error'));
		$this->controller->response->type('html');
		$this->controller->response->send();
	}
}
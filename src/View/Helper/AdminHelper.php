<?php
/**
 * 管理端视图助手
 *
 * @copyright LeeAdmin
 * @license   MIT License (http://www.opensource.org/licenses/mit-license.php)
 * @author    Will.Lee <im.will.lee@gmail.com>
 * @package   App.View.Helper
 */

namespace App\View\Helper;

use Cake\Core\Configure;
use Cake\Event\Event;
use Cake\View\Helper;

class AdminHelper extends Helper {

/**
 * 显示页面标题
 * 
 * @return string
 */
	public function title() {
		$title = Configure::read('Basic.title');
		$delimiter = Configure::read('Basic.title_delimiter');
		if ($this->_View->viewVars['controllerTitle'] != '') {
			$title .= $delimiter . $this->_View->viewVars['controllerTitle'];
		}
		if ($this->_View->viewVars['actionTitle'] != '') {
			$title .= $delimiter . $this->_View->viewVars['actionTitle'];
		}
		return h($title);
	}
}

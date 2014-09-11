<?php
/**
 * 项目模板助手基础
 *
 * @copyright LeeAdmin
 * @license   MIT License (http://www.opensource.org/licenses/mit-license.php)
 * @author    Will.Lee <im.will.lee@gmail.com>
 * @package   App.View.Helper
 */

namespace App\View\Helper;

use Cake\Core\Configure;
use Cake\View\Helper;

class AppHelper extends Helper {

/**
 * 显示页面标题
 * 
 * @return string
 */
	public function title() {
		$title = null;
		$delimiter = Configure::read('Basic.title_delimiter');
		if (isset($this->_View->viewVars['mainTitle']) && $this->_View->viewVars['mainTitle'] != '') {
			$title .= $this->_View->viewVars['mainTitle'];
		}
		if (isset($this->_View->viewVars['subTitle']) && $this->_View->viewVars['subTitle'] != '') {
			$title .= $delimiter . $this->_View->viewVars['subTitle'];
		}
		$title .= $delimiter . Configure::read('Basic.title');
		return h($title);
	}

/**
 * 字符串url解析
 * url格式规则
 * 插件格式:plugin.controller/action 和 plugin.prefix/controller/action
 * 基本格式:controller/action 和 prefix/controller/action
 * 
 * @param string $url url地址
 * @return array
 */
	public function parseUrl($url) {
		list($plugin, $link) = pluginSplit($url);
		$link = explode('/', $link);
		if (isset($link[2])) {
			return ['plugin' => $plugin, 'controller' => $link[1], 'action' => $link[2], 'prefix' => $link[0]];
		} else {
			return ['plugin' => $plugin, 'controller' => $link[0], 'action' => $link[1], 'prefix' => false];
		}
	}
}

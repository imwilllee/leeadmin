<?php
/**
 * 重载视图类
 *
 * @copyright LeeAdmin
 * @license   MIT License (http://www.opensource.org/licenses/mit-license.php)
 * @author    Will.Lee <im.will.lee@gmail.com>
 * @package   App.View
 */
namespace App\View;

use Cake\Utility\Inflector;
use Cake\View\View as CakeView;

class View extends CakeView {

/**
 * 更改Element位置
 * 
 * @param string $name Element名称
 * @return mixed
 */
	protected function _getElementFileName($name) {
		list($plugin, $name) = $this->pluginSplit($name);
		$paths = $this->_paths($plugin);
		$first = false;
		foreach ($paths as $path) {
			// 优先路径增加前缀目录
			if ($first === false) {
				$path .= Inflector::camelize($this->request->params['prefix']) . DS;
				$first = true;
			}
			$path .= 'Element' . DS . $name . $this->_ext;
			if (file_exists($path)) {
				return $path;
			}
		}
		return false;
	}
}

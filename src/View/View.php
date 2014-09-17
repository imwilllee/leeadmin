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

use Cake\Core\App;
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
		// 包含路由前缀
		if (!empty($this->request->params['prefix'])) {
			$viewPaths = App::path('Template');
			foreach ($viewPaths as $path) {
				array_unshift($paths, $path . Inflector::camelize($this->request->params['prefix']) . DS);
			}
		}
		foreach ($paths as $path) {
			if (file_exists($path . 'Element' . DS . $name . $this->_ext)) {
				return $path . 'Element' . DS . $name . $this->_ext;
			}
		}
		return false;
	}
}

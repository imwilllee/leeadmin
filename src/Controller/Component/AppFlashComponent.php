<?php
/**
 * 菜单节点管理组件
 *
 * 核心菜单定义在config/menus.php文件内
 * 插件菜单定义在插件目录下的config/menus.php文件内
 * 调用refresh()方法刷新所有菜单
 *
 * @copyright LeeAdmin
 * @license   MIT License (http://www.opensource.org/licenses/mit-license.php)
 * @author    Will.Lee <im.will.lee@gmail.com>
 * @package   App.Controller.Component
 */
namespace App\Controller\Component;

use Cake\Controller\Component\FlashComponent;
use Cake\Core\Configure;
use Cake\Utility\Inflector;

class AppFlashComponent extends FlashComponent {

/**
 * Used to set a session variable that can be used to output messages in the view.
 *
 * In your controller: $this->Flash->set('This has been saved');
 *
 * ### Options:
 *
 * - `key` The key to set under the session's Flash key
 * - `element` The element used to render the flash message. Default to 'default'.
 * - `params` An array of variables to make available when using an element
 *
 * @param string|\Exception $message Message to be flashed. If an instance
 *   of \Exception the exception message will be used and code will be set
 *   in params.
 * @param array $options An array of options
 * @return void
 */
	public function set($message, array $options = []) {
		$options += $this->config();

		if ($message instanceof \Exception) {
			$options['params'] += ['code' => $message->getCode()];
			$message = $message->getMessage();
		}

		list($plugin, $element) = pluginSplit($options['element']);
		$prefix = '';
		if (Configure::read('prefix')) {
			$prefix = Inflector::camelize(Configure::read('prefix')) . '/';
		}
		if ($plugin) {
			$options['element'] = $plugin . '.' . $prefix . 'Flash/' . $prefix . $element;
		} else {
			$options['element'] = $prefix . 'Flash/' . $element;
		}

		$this->_session->write('Flash.' . $options['key'], [
			'message' => $message,
			'key' => $options['key'],
			'element' => $options['element'],
			'params' => $options['params']
		]);
	}
}

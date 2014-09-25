<?php
/**
 * 插件管理组件
 *
 * @copyright LeeAdmin
 * @license   MIT License (http://www.opensource.org/licenses/mit-license.php)
 * @author    Will.Lee <im.will.lee@gmail.com>
 * @package   App.Controller.Component
 */
namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\Core\App;
use Cake\Core\Configure;
use Cake\Core\Plugin;
use Cake\Event\Event;
use Cake\Filesystem\Folder;
use Cake\ORM\TableRegistry;

class PluginComponent extends Component {

/**
 * 组件
 * 
 * @var array
 */
	public $components = ['Flash'];

/**
 * 初始化方法
 *
 * @param Cake\Event\Event $event 事件对象
 * @return void
 */
	public function initialize(Event $event) {
	}

/**
 * 启动方法
 * 
 * @param Cake\Event\Event $event 事件对象
 * @return void
 */
	public function startup(Event $event) {
	}

/**
 * 获取没有安装的插件
 * 
 * @return void
 */
	public function getNotInstalledPlugins() {
		// 未安装插件
		$notInstalled = [];
		// 插件安装路径
		$pluginInstallDir = App::path('Plugin');
		foreach ($pluginInstallDir as $dir) {
			// 所有插件所在路径
			$folder = new Folder($dir);
			$pluginPaths = $folder->read(true, true);
			if (!empty($pluginPaths[0])) {
				foreach ($pluginPaths[0] as $pluginCode) {
					// 判断是不是未安装过的插件
					if (!Configure::read('Plugin.' . $pluginCode) && !Plugin::loaded($pluginCode)) {
						$pluginPath = $dir . $pluginCode . DS;
						$handlerPath = $pluginPath . 'config' . DS . 'handler.php';
						if (file_exists($handlerPath)) {
							$notInstalled[$pluginCode] = include $handlerPath;
						}
					}
				}
			}
		}
		return $notInstalled;
	}

/**
 * 插件安装
 * 
 * @param string $pluginCode 插件代码
 * @return boolean
 */
	public function install($pluginCode) {
		if (Configure::read('Plugin.' . $pluginCode)) {
			$this->Flash->error('该插件已安装！');
			return false;
		}
		// 未安装插件
		$notInstalled = $this->getNotInstalledPlugins();
		if (!isset($notInstalled[$pluginCode])) {
			$this->Flash->error('插件代码不存在！');
			return false;
		}
		$plugin = $notInstalled[$pluginCode];
		if (!empty($plugin['basic']['require'])) {
			foreach ($plugin['basic']['require'] as $requirePluginCode) {
				if (!Plugin::loaded($requirePluginCode)) {
					$this->Flash->error(sprintf('依赖插件代码为%s的插件未安装或未启用！', $requirePluginCode));
					return false;
				}
			}
		}
		$pluginsTable = TableRegistry::get('Plugins');
		if ($pluginsTable->register($pluginCode, $plugin)) {
			return true;
		}
		return false;
	}

}
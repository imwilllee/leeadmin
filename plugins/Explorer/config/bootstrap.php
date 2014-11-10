<?php
/**
 * 文件管理器插件
 * 引导文件
 *
 * @copyright LeeAdmin.Wechat
 * @license   MIT License (http://www.opensource.org/licenses/mit-license.php)
 * @author    Will.Lee <im.will.lee@gmail.com>
 * @package   Explorer.config
 */
use Cake\Core\Configure;
use Cake\Routing\Router;

/**
 * 路由定义
 */
Router::plugin('Explorer', function ($plugin) {
	$plugin->fallbacks();
	$plugin->prefix('admin', function ($routes) {
		$routes->fallbacks();
	});
});

/**
 * 上传配置
 */
Configure::write('Explorer', [
	'upload_options' => [
		'accept_file_types' => '/\.(gif|jpe?g|png)$/i',
		'param_name' => 'files',
		'max_file_size' => 10 * 1024 * 1024
	]
]);

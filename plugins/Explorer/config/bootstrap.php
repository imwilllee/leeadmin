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
	// 根目录设置
	'root_path' => ROOT . DS,
	// 目录创建规则
	'check_mkdir_name' => '/^[~!@$&)(\-_=0-9a-zA-Z]{1,32}$/i',
	'upload_options' => [
		'check_file_name' => '/^[~!@$&)(\-_=0-9a-zA-Z]{1,254}$/i',
		'accept_file_types' => '/\.(gif|jpe?g|png|html|txt)$/i',
		'param_name' => 'files',
		'max_file_size' => 10 * 1024 * 1024
	]
]);

<?php
/**
 * 微信公众平台插件
 * 路由定义
 *
 * @copyright LeeAdmin.Wechat
 * @license   MIT License (http://www.opensource.org/licenses/mit-license.php)
 * @author    Will.Lee <im.will.lee@gmail.com>
 * @package   Wechat.config
 */
use Cake\Routing\Router;

Router::plugin('Wechat', function($plugin) {
	$plugin->fallbacks();
	$plugin->prefix('admin', function($routes) {
		$routes->fallbacks();
	});
});
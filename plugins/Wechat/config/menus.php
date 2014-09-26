<?php
/**
 * 微信公众平台插件
 * 菜单配置
 *
 * @copyright LeeAdmin
 * @license   MIT License (http://www.opensource.org/licenses/mit-license.php)
 * @author    Will.Lee <im.will.lee@gmail.com>
 * @package   Wechat.config
 */
return [
	[
		'menu_code' => 'wechat',
		'parent_code' => null,
		'name' => '微信公众平台',
		'link' => null,
		'class' => 'fa fa-wechat',
		'rank' => 0,
		'display_flg' => true,
		'menu_nodes' => [
			['link' => 'Wechat.admin/Account/add', 'name' => '公众号创建'],
			['link' => 'Wechat.admin/Account/index', 'name' => '公众号查看'],
			['link' => 'Wechat.admin/Account/view', 'name' => '公众号详细'],
			['link' => 'Wechat.admin/Account/edit', 'name' => '公众号编辑'],
			['link' => 'Wechat.admin/Account/delete', 'name' => '公众号删除'],
			['link' => 'Wechat.admin/Subscribers/index', 'name' => '订阅用户查看'],
			['link' => 'Wechat.admin/Subscribers/view', 'name' => '订阅用户详细'],
			['link' => 'Wechat.admin/Subscribers/edit', 'name' => '订阅用户编辑'],
			['link' => 'Wechat.admin/Subscribers/delete', 'name' => '订阅用户删除']
		]
	],
	[
		'menu_code' => null,
		'parent_code' => 'wechat',
		'name' => '公众号管理',
		'link' => 'Wechat.admin/Account/index',
		'class' => null,
		'rank' => 0,
		'display_flg' => true
	],
	[
		'menu_code' => null,
		'parent_code' => 'wechat',
		'name' => '添加公众号',
		'link' => 'Wechat.admin/Account/add',
		'class' => null,
		'rank' => 0,
		'display_flg' => true
	],
	[
		'menu_code' => null,
		'parent_code' => 'wechat',
		'name' => '订阅用户',
		'link' => 'Wechat.admin/Subscribers/index',
		'class' => null,
		'rank' => 0,
		'display_flg' => true
	]
];
<?php
/**
 * 微信公众平台插件定义
 *
 * @copyright LeeAdmin
 * @license   MIT License (http://www.opensource.org/licenses/mit-license.php)
 * @author    Will.Lee <im.will.lee@gmail.com>
 * @package   Wechat.config
 */
return [
	'basic' => [
		'name' => '微信公众平台',
		'version' => '0.01',
		'developer' => 'Will.Lee <im.will.lee@gmail.com>',
		'explain' => '微信公众平台',
		'autoload' => true,
		'bootstrap' => false,
		'routes' => true,
		'require' => []
	],
	'menus' => [
		[
			'menu_code' => 'wechat',
			'parent_code' => null,
			'name' => '微信公众平台',
			'link' => null,
			'class' => 'fa fa-wechat',
			'rank' => 0,
			'display_flg' => true
		],
		[
			'menu_code' => null,
			'parent_code' => 'wechat',
			'name' => '公众号管理',
			'link' => 'Wechat.admin/account/index',
			'class' => null,
			'rank' => 0,
			'display_flg' => true,
			'menu_nodes' => [
				['link' => 'Wechat.admin/account/add', 'name' => '创建'],
				['link' => 'Wechat.admin/account/index', 'name' => '查看'],
				['link' => 'Wechat.admin/account/view', 'name' => '详细'],
				['link' => 'Wechat.admin/account/edit', 'name' => '编辑'],
				['link' => 'Wechat.admin/account/delete', 'name' => '删除']
			]
		],
		[
			'menu_code' => null,
			'parent_code' => 'wechat',
			'name' => '添加公众号',
			'link' => 'Wechat.admin/account/add',
			'class' => null,
			'rank' => 0,
			'display_flg' => true
		],
		[
			'menu_code' => null,
			'parent_code' => 'wechat',
			'name' => '订阅用户',
			'link' => 'Wechat.admin/subscribers/index',
			'class' => null,
			'rank' => 0,
			'display_flg' => true,
			'menu_nodes' => [
				['link' => 'Wechat.admin/subscribers/index', 'name' => '查看'],
				['link' => 'Wechat.admin/subscribers/view', 'name' => '详细'],
				['link' => 'Wechat.admin/subscribers/edit', 'name' => '编辑'],
				['link' => 'Wechat.admin/subscribers/delete', 'name' => '删除']
			]
		],
	]
];
<?php
/**
 * 核心菜单定义
 * link定义格式规则
 * 插件格式:plugin.controller/action 和 plugin.prefix/controller/action
 * 基本格式:controller/action 和 prefix/controller/action
 */
return [
	[
		'menu_code' => 'dashboard',
		'parent_code' => null,
		'name' => '控制面板',
		'link' => 'admin/Dashboard/index',
		'class' => 'fa fa-dashboard',
		'rank' => 0,
		'display_flg' => false,
		'menu_nodes' => [
			['link' => 'admin/Dashboard/index', 'name' => '控制面板']
		]
	],
	[
		'menu_code' => 'user',
		'parent_code' => null,
		'name' => '系统管理员',
		'link' => null,
		'class' => 'fa fa-user',
		'rank' => 0,
		'display_flg' => true,
		'menu_nodes' => [
			['link' => 'admin/Users/add', 'name' => '创建'],
			['link' => 'admin/Users/index', 'name' => '查看'],
			['link' => 'admin/Users/view', 'name' => '详细'],
			['link' => 'admin/Users/edit', 'name' => '编辑'],
			['link' => 'admin/Users/active', 'name' => '状态变更'],
			['link' => 'admin/Users/delete', 'name' => '删除']
		]
	],
	[
		'menu_code' => null,
		'parent_code' => 'user',
		'name' => '管理员一览',
		'link' => 'admin/Users/index',
		'class' => null,
		'rank' => 0,
		'display_flg' => true
	],
	[
		'menu_code' => null,
		'parent_code' => 'user',
		'name' => '创建管理员',
		'link' => 'admin/Users/add',
		'class' => null,
		'rank' => 0,
		'display_flg' => true
	],
	[
		'menu_code' => 'users',
		'parent_code' => null,
		'name' => '用户组管理',
		'link' => null,
		'class' => 'fa fa-users',
		'rank' => 0,
		'display_flg' => true,
		'menu_nodes' => [
			['link' => 'admin/Groups/add', 'name' => '创建'],
			['link' => 'admin/Groups/index', 'name' => '查看'],
			['link' => 'admin/Groups/view', 'name' => '详细'],
			['link' => 'admin/Groups/edit', 'name' => '编辑'],
			['link' => 'admin/Groups/delete', 'name' => '删除'],
			['link' => 'admin/Groups/active', 'name' => '状态变更'],
			['link' => 'admin/Groups/access', 'name' => '访问权限'],
		]
	],
	[
		'menu_code' => null,
		'parent_code' => 'users',
		'name' => '用户组一览',
		'link' => 'admin/Groups/index',
		'class' => null,
		'rank' => 0,
		'display_flg' => true
	],
	[
		'menu_code' => null,
		'parent_code' => 'users',
		'name' => '创建用户组',
		'link' => 'admin/Groups/add',
		'class' => null,
		'rank' => 0,
		'display_flg' => true
	],
	[
		'menu_code' => 'setting',
		'parent_code' => null,
		'name' => '系统设置',
		'link' => null,
		'class' => 'fa fa-cog',
		'rank' => 0,
		'display_flg' => true,
		'menu_nodes' => [
			['link' => 'admin/Options/index', 'name' => '站点信息'],
			['link' => 'admin/Options/seo', 'name' => 'SEO设置'],
		]
	],
	[
		'menu_code' => null,
		'parent_code' => 'setting',
		'name' => '站点信息',
		'link' => 'admin/Options/index',
		'class' => null,
		'rank' => 0,
		'display_flg' => true
	],
	[
		'menu_code' => null,
		'parent_code' => 'setting',
		'name' => 'SEO设置',
		'link' => 'admin/Options/seo',
		'class' => null,
		'rank' => 0,
		'display_flg' => true
	],
];

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
		'menu_code' => 'content',
		'parent_code' => null,
		'name' => '内容管理',
		'link' => null,
		'class' => 'fa fa-book',
		'rank' => 0,
		'display_flg' => true,
		'menu_nodes' => [
			['link' => 'admin/Channels/index', 'name' => '栏目一览'],
			['link' => 'admin/Channels/add', 'name' => '添加栏目'],
			['link' => 'admin/Channels/edit', 'name' => '栏目编辑'],
			['link' => 'admin/Channels/delete', 'name' => '栏目删除'],
			['link' => 'admin/Channels/rank', 'name' => '栏目排序']
		]
	],
	[
		'menu_code' => null,
		'parent_code' => 'content',
		'name' => '栏目一览',
		'link' => 'admin/Channels/index',
		'class' => null,
		'rank' => 0,
		'display_flg' => true
	],
	[
		'menu_code' => null,
		'parent_code' => 'content',
		'name' => '添加栏目',
		'link' => 'admin/Channels/add',
		'class' => null,
		'rank' => 0,
		'display_flg' => true
	],
	[
		'menu_code' => null,
		'parent_code' => 'content',
		'name' => '文章管理',
		'link' => 'admin/Articles/index',
		'class' => null,
		'rank' => 0,
		'display_flg' => true,
		'menu_nodes' => [
			['link' => 'admin/Articles/index', 'name' => '文章一览'],
			['link' => 'admin/Articles/attribute', 'name' => '属性变更'],
			['link' => 'admin/Articles/add', 'name' => '添加文章'],
			['link' => 'admin/Articles/edit', 'name' => '文章编辑'],
			['link' => 'admin/Articles/delete', 'name' => '文章删除']
		]
	],
	[
		'menu_code' => 'contact',
		'parent_code' => null,
		'name' => '留言管理',
		'link' => null,
		'class' => 'fa fa-comments',
		'rank' => 0,
		'display_flg' => true,
		'menu_nodes' => [
			['link' => 'admin/Contacts/index', 'name' => '留言一览'],
			['link' => 'admin/Contacts/view', 'name' => '留言详细'],
			['link' => 'admin/Contacts/attribute', 'name' => '状态更新'],
			['link' => 'admin/Contacts/delete', 'name' => '留言删除']
		]
	],
	[
		'menu_code' => null,
		'parent_code' => 'contact',
		'name' => '留言一览',
		'link' => 'admin/Contacts/index',
		'class' => null,
		'rank' => 0,
		'display_flg' => true
	],
	[
		'menu_code' => 'attachment',
		'parent_code' => null,
		'name' => '附件管理',
		'link' => null,
		'class' => 'fa fa-paperclip',
		'rank' => 0,
		'display_flg' => true,
		'menu_nodes' => [
			['link' => 'admin/Attachments/index', 'name' => '附件一览'],
			['link' => 'admin/Attachments/upload', 'name' => '上传附件'],
			['link' => 'admin/Attachments/delete', 'name' => '删除附件']
		]
	],
	[
		'menu_code' => null,
		'parent_code' => 'attachment',
		'name' => '附件一览',
		'link' => 'admin/Attachments/index',
		'class' => null,
		'rank' => 0,
		'display_flg' => true
	],
	[
		'menu_code' => null,
		'parent_code' => 'attachment',
		'name' => '上传附件',
		'link' => 'admin/Attachments/upload',
		'class' => null,
		'rank' => 0,
		'display_flg' => true
	],
	[
		'menu_code' => 'element',
		'parent_code' => null,
		'name' => '页面元素管理',
		'link' => null,
		'class' => 'fa fa-laptop',
		'rank' => 0,
		'display_flg' => true
	],
	[
		'menu_code' => null,
		'parent_code' => 'element',
		'name' => '首页KV图',
		'link' => 'admin/Carousels/index',
		'class' => null,
		'rank' => 0,
		'display_flg' => true,
		'menu_nodes' => [
			['link' => 'admin/Carousels/index', 'name' => 'KV图一览'],
			['link' => 'admin/Carousels/edit', 'name' => 'KV图添加(编辑)'],
			['link' => 'admin/Carousels/delete', 'name' => 'KV图附件']
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
			['link' => 'admin/Users/index', 'name' => '管理员一览'],
			['link' => 'admin/Users/add', 'name' => '创建管理员'],
			['link' => 'admin/Users/view', 'name' => '管理员详细'],
			['link' => 'admin/Users/edit', 'name' => '管理员编辑'],
			['link' => 'admin/Users/active', 'name' => '状态变更'],
			['link' => 'admin/Users/delete', 'name' => '管理员删除'],
			['link' => 'admin/Users/change_password', 'name' => '更改密码']
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
			['link' => 'admin/Groups/index', 'name' => '用户组一览'],
			['link' => 'admin/Groups/add', 'name' => '创建用户组'],
			['link' => 'admin/Groups/view', 'name' => '用户组详细'],
			['link' => 'admin/Groups/edit', 'name' => '用户组编辑'],
			['link' => 'admin/Groups/delete', 'name' => '用户组删除'],
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
			['link' => 'admin/Options/index', 'name' => '站点信息']
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
	]
];

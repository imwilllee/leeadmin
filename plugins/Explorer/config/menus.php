<?php
/**
 * 文件管理器插件
 * 菜单配置
 *
 * @copyright LeeAdmin
 * @license   MIT License (http://www.opensource.org/licenses/mit-license.php)
 * @author    Will.Lee <im.will.lee@gmail.com>
 * @package   Explorer.config
 */
return [
	[
		'menu_code' => null,
		'parent_code' => 'explorer',
		'name' => '文件管理器',
		'link' => 'Explorer.admin/FileManager/index',
		'class' => null,
		'rank' => 0,
		'display_flg' => true,
		'menu_nodes' => [
			['link' => 'Explorer.admin/FileManager/index', 'name' => '文件一览'],
			['link' => 'Explorer.admin/FileManager/mkdir', 'name' => '创建目录'],
			['link' => 'Explorer.admin/FileManager/upload', 'name' => '文件上传'],
			['link' => 'Explorer.admin/FileManager/edit', 'name' => '文件编辑'],
			['link' => 'Explorer.admin/FileManager/delete', 'name' => '文件删除'],
			['link' => 'Explorer.admin/FileManager/preview', 'name' => '文件预览'],
			['link' => 'Explorer.admin/FileManager/download', 'name' => '文件下载'],
		]
	]
];

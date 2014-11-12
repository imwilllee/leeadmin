<?php
/**
 * 项目常用定义文件
 *
 * @copyright LeeAdmin
 * @license   MIT License (http://www.opensource.org/licenses/mit-license.php)
 * @author    Will.Lee <im.will.lee@gmail.com>
 */
$config = [
/**
 * 常用配置
 */
	'Common' => [
		'status' => [
			0 => '禁用',
			1 => '启用'
		],
		'sex' => [
			0 => '保密',
			1 => '男性',
			2 => '女性'
		],
		'run_status' => [
			0 => '运行中',
			1 => '暂停访问'
		],
		'options' => [
			'index' => 1,
			'seo' => 2
		]
	],
/**
 * 分类配置
 */
	'Category' => [
		'type' => [
			'article' => [
				'type_id' => 1,
				'name' => '文章分类'
			],
			'product' => [
				'type_id' => 2,
				'name' => '产品分类'
			]
		]
	]
];

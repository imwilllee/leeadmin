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
		'boolen' => [
			0 => '否',
			1 => '是'
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
	'Articles' => [
		'status' => [
			0 => '草稿',
			1 => '公开'
		],
		'delete' => [
			0 => '不允许',
			1 => '允许'
		]
	],
	'Channels' => [
		'type' => [
			1 => '文章',
			2 => '单页'
		]
	],
	'Contacts' => [
		'type' => [
			1 => '申请目录',
			2 => '申请报价'
		],
		'notify' => [
			0 => '未读',
			1 => '已读'
		],
	],
	'Carousels' => [
		'type' => [
			1 => '首页滚动大图',
			2 => '首页固定小图'
		]
	],
	'QuestionCategories' => [
		'category' => [
			1 => '喷嘴系列常见问题',
			2 => '加湿系统常见问题'
		]
	],
/**
 * 附件上传配置
 */
	'Attachments' => [
		// 文件上传
		'file' => [
			'upload_dir' => UPLOAD_DIR . 'files' . DS . YYYY . DS . MM . DS . DD . DS,
			'save_rule' => 'hash',
			//'accept_file_types' => '/\.(gif|jpe?g|png|bmp)$/i',
			'max_file_size' => 2 * 1024 * 1024,
			'preview_url' => sprintf('/uploads/files/%s/%s/%s/', YYYY, MM, DD)
		],
		// 图片上传
		'image' => [
			'upload_dir' => UPLOAD_DIR . 'images' . DS . YYYY . DS . MM . DS . DD . DS,
			'save_rule' => 'hash',
			'accept_file_types' => '/\.(gif|jpe?g|png|bmp)$/i',
			'max_file_size' => 2 * 1024 * 1024,
			'preview_url' => sprintf('/uploads/images/%s/%s/%s/', YYYY, MM, DD)
		],
		// flash上传
		'flash' => [
			'upload_dir' => UPLOAD_DIR . 'flash' . DS . YYYY . DS . MM . DS . DD . DS,
			'save_rule' => 'hash',
			'accept_file_types' => '/\.(swf)$/i',
			'max_file_size' => 2 * 1024 * 1024,
			'preview_url' => sprintf('/uploads/flash/%s/%s/%s/', YYYY, MM, DD)
		]
	]
];

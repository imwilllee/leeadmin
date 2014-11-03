<?php
/**
 * 项目配置
 *
 * @copyright LeeAdmin
 * @license   MIT License (http://www.opensource.org/licenses/mit-license.php)
 * @author    Will.Lee <im.will.lee@gmail.com>
 */

$config = [
/**
 * 项目状态
 */
	'debug' => true,

/**
 * 安全秘钥字符串
 */
	'Security' => [
		'salt' => '235349823baaab206976dcc7efbf3510ce02de1a4c179e70ca0aa15fca4b08dc',
	],

/**
 * 缓存配置
 */
	'Cache' => [
		// 长时间缓存
		'long' => [
			'className' => 'File',
			'prefix' => 'la_long_cache_',
			'serialize' => true,
			'duration' => '+999 days',
		]
	],

/**
 * 异常配置
 */
	'Error' => [
		'errorLevel' => E_ALL & ~E_DEPRECATED,
		'exceptionRenderer' => 'App\Error\ExceptionRenderer',
		'skipLog' => [],
		'log' => true,
		'trace' => true,
	],

/**
 * 邮件配置
 */
	'EmailTransport' => [
		'default' => [
			'className' => 'Mail',
			// The following keys are used in SMTP transports
			'host' => 'localhost',
			'port' => 25,
			'timeout' => 30,
			'username' => 'user',
			'password' => 'secret',
			'client' => null,
			'tls' => null,
		],
	],

	'Email' => [
		'default' => [
			'transport' => 'default',
			'from' => 'you@localhost',
			//'charset' => 'utf-8',
			//'headerCharset' => 'utf-8',
		],
	],

/**
 * 数据库配置
 */
	'Datasources' => [
		'default' => [
			'className' => 'Cake\Database\Connection',
			'driver' => 'Cake\Database\Driver\Mysql',
			'persistent' => false,
			'host' => 'localhost',
			'username' => 'root',
			'password' => '',
			'database' => 'leeadmin',
			'encoding' => 'utf8',
			'timezone' => 'UTC',
			'cacheMetadata' => true,
			'quoteIdentifiers' => true,
			//'init' => ['SET GLOBAL innodb_stats_on_metadata = 0'],
		],
	],

/**
 * 日志配置
 */
	'Log' => [
		'debug' => [
			'className' => 'Cake\Log\Engine\FileLog',
			'file' => 'debug',
			'levels' => ['notice', 'info', 'debug'],
		],
		'error' => [
			'className' => 'Cake\Log\Engine\FileLog',
			'file' => 'error',
			'levels' => ['warning', 'error', 'critical', 'alert', 'emergency'],
		],
	],

/**
 * session 配置
 */
	'Session' => [
		'defaults' => 'php',
		'cookie' => 'lasid',
		'timeout' => 30
	],
];

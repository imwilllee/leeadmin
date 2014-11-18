<?php
/**
 * 项目全局函数定义
 *
 * @copyright LeeAdmin
 * @license   MIT License (http://www.opensource.org/licenses/mit-license.php)
 * @author    Will.Lee <im.will.lee@gmail.com>
 * @package   App.Core
 */

/**
 * 系统时区列表
 *
 * @return array
 */
function get_time_zone_list() {
	$timezoneList = [];
	foreach (timezone_identifiers_list() as $timezone) {
		$timezoneList[$timezone] = $timezone;
	}
	return $timezoneList;
}

/**
 * 格式化日期
 * date_format简写
 *
 * @param mixd $date 日期
 * @param string $format 格式
 * @return string
 */
function df($date, $format = 'Y-m-d H:i:s') {
	if (empty($date)) {
		return null;
	}
	if (is_string($date)) {
		$dt = new DateTime($date);
		return $dt->format($format);
	} else {
		return $date->format($format);
	}
}

/**
 * url编码
 *
 * @param string $url 未编码的url
 * @return string
 */
function url_encode($url) {
	return rawurlencode($url);
}

/**
 * url解码
 *
 * @param string $url 编码的url
 * @return string
 */
function url_decode($url) {
	return rawurldecode($url);
}

/**
 * 获取文件扩展名
 *
 * @param string $filename 文件名
 * @return string
 */
function get_file_ext($filename) {
	return strtolower(pathinfo($filename, PATHINFO_EXTENSION));
}

/**
 * 格式化文件大小
 *
 * @param int $bytes 字节
 * @param int $decimals 小数位
 * @return string
 */
function size_format($bytes, $decimals = 0) {
	$quant = array(
		'TB' => 1099511627776,
		'GB' => 1073741824,
		'MB' => 1048576,
		'kB' => 1024,
		'B ' => 1,
	);
	foreach ($quant as $unit => $mag) {
		if (doubleval($bytes) >= $mag) {
			return number_format( $bytes / $mag, $decimals ) . ' ' . $unit;
		}
	}
	return false;
}

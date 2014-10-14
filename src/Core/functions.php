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
		$zone = explode('/', $timezone);
		if (isset($zone[1])) {
			$timezoneList[$zone[0]][$timezone] = $zone[1];
		} else {
			$timezoneList[$zone[0]][$timezone] = $zone[0];
		}
	}
	// UTC时差
	$utcRange = range(-12, 5.5, 0.5);
	$utcRange = array_merge($utcRange, [
		5.75, 6, 6.5, 7, 7.5, 8, 8.5, 8.75, 9, 9.5, 10, 10.5, 11, 11.5, 12, 12.75, 13, 13.75, 14
	]);
	foreach ($utcRange as $utc) {
		if ($utc >= 0) {
			$utcKey = '+' . $utc;
		} else {
			$utcKey = (string)$utc;
		}
		$utcKey = 'UTC' . $utcKey;
		$utcVal = str_replace(['.25', '.5', '.75'], [':15', ':30', ':45'], $utcKey);
		$timezoneList['UTC'][$utcKey] = $utcVal;
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

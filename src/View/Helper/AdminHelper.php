<?php
/**
 * 管理端模板助手
 *
 * @copyright LeeAdmin
 * @license   MIT License (http://www.opensource.org/licenses/mit-license.php)
 * @author    Will.Lee <im.will.lee@gmail.com>
 * @package   App.View.Helper
 */

namespace App\View\Helper;

use App\View\Helper\AppHelper;

class AdminHelper extends AppHelper {

/**
 * 使用模板助手
 * 
 * @var array
 */
	public $helpers = ['Html', 'Form'];

/**
 * 图标编辑按钮
 * 
 * @param array $url 链接数组
 * @param array $options 配置项
 * @return string
 */
	public function iconEditLink($url, $options = []) {
		$options = array_merge(
			['escape' => false, 'data-toggle' => 'tooltip', 'data-original-title' => '编辑'],
			$options
		);
		return $this->Html->link('<i class="fa fa-1 fa-edit"></i>', $url, $options);
	}

/**
 * 图标查看按钮
 * 
 * @param array $url 链接数组
 * @param array $options 配置项
 * @return string
 */
	public function iconViewLink($url, $options = []) {
		$options = array_merge(
			['escape' => false, 'data-toggle' => 'tooltip', 'data-original-title' => '查看'],
			$options
		);
		return $this->Html->link('<i class="fa fa-1 fa-search"></i>', $url, $options);
	}

/**
 * 图标删除按钮
 * 
 * @param array $url 链接数组
 * @param array $options 配置项
 * @return string
 */
	public function iconDeleteLink($url, $options = []) {
		$options = array_merge(
			['escape' => false, 'data-toggle' => 'tooltip', 'data-original-title' => '删除', 'confirm' => '确认删除？'],
			$options
		);
		return $this->Form->postLink('<i class="fa fa-1 fa-trash-o"></i>', $url, $options);
	}
}

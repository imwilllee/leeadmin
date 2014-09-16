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
use Cake\Event\Event;

class AdminHelper extends AppHelper {

/**
 * 使用模板助手
 * 
 * @var array
 */
	public $helpers = ['Html', 'Form'];

/**
 * 模板渲染前置回调函数
 *
 * @param \Cake\Event\Event $event 事件对象
 * @param string $viewFile 视图文件
 * @return void
 */
	public function beforeRender(Event $event, $viewFile) {
		$this->Form->templates([
			'error' => '<p class="text-red">{{content}}</p>',
		]);
	}

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

/**
 * 显示错误信息
 * 
 * @param string $field 字段名称
 * @return string
 */
	public function error($field) {
		if ($this->Form->isFieldError($field)) {
			return $this->Form->error($field);
		}
	}

/**
 * 显示错误高亮Class
 * 
 * @param string $field 字段名称
 * @return string
 */
	public function errorClass($field) {
		if ($this->Form->isFieldError($field)) {
			return ' has-error';
		}
	}
}

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
	public $helpers = ['Html', 'Form', 'Session'];

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
 * 图标链接
 *
 * @param string $iconClass 图标样式
 * @param array $url url链接
 * @param array $options 配置项
 * @return string
 */
	public function iconLink($iconClass, $url, $options = []) {
		$options = array_merge(
			['escape' => false, 'data-toggle' => 'tooltip'],
			$options
		);
		return $this->Html->link(sprintf('<i class="%s"></i>', $iconClass), $url, $options);
	}

/**
 * 编辑图标链接
 *
 * @param array $url 链接数组
 * @param array $options 配置项
 * @return string
 */
	public function iconEditLink($url, $options = []) {
		$options = array_merge(
			['data-original-title' => '编辑'],
			$options
		);
		return $this->iconLink('fa fa-1 fa-edit', $url, $options);
	}

/**
 * 查看图标链接
 *
 * @param array $url 链接数组
 * @param array $options 配置项
 * @return string
 */
	public function iconViewLink($url, $options = []) {
		$options = array_merge(
			['data-original-title' => '查看'],
			$options
		);
		return $this->iconLink('fa fa-1 fa-search', $url, $options);
	}

/**
 * 删除图标链接
 *
 * @param array $url 链接数组
 * @param array $options 配置项
 * @return string
 */
	public function iconDeleteLink($url, $options = []) {
		$options = array_merge(
			['data-toggle' => 'tooltip', 'data-original-title' => '删除', 'confirm' => '确认删除？', 'escape' => false],
			$options
		);
		return $this->Form->postLink('<i class="fa fa-1 fa-trash-o"></i>', $url, $options);
	}

/**
 * 显示错误信息
 *
 * @param string $field 字段名称
 * @param array $errors 错误信息
 * @return string
 */
	public function error($field, $errors = []) {
		if ($this->Form->isFieldError($field)) {
			return $this->Form->error($field);
		} elseif (isset($errors[$field])) {
			return $this->Form->formatTemplate('error', ['content' => array_pop($errors[$field])]);
		}
		return null;
	}

/**
 * 显示错误高亮Class
 *
 * @param string $field 字段名称
 * @param array $errors 错误信息
 * @return string
 */
	public function errorClass($field, $errors = []) {
		if ($this->Form->isFieldError($field) || isset($errors[$field])) {
			return ' has-error';
		}
		return null;
	}

/**
 * 检查菜单是否有权限
 *
 * @param array $menu 菜单信息
 * @return boolean
 */
	public function checkMenuAccess($menu) {
		// 创始人排除
		if ($this->Session->read('Auth.User.id') == INIT_GROUP_ID) {
			return true;
		}
		$userAccess = $this->Session->read('Auth.Access');
		// 存在子菜单
		if (!empty($menu['sub_menus'])) {
			foreach ($menu['sub_menus'] as $sub) {
				// 如果子菜单中有一个有权限 展示主菜单
				if (in_array($sub['link'], $userAccess)) {
					return true;
				}
			}
		} else {
			if (in_array($menu['link'], $userAccess)) {
				return true;
			}
		}
		return false;
	}

/**
 * 判断文件是否为图片
 *
 * @param string $filename 文件名
 * @return boolean
 */
	public function checkImageFile($filename) {
		$ext = $this->getFileExt($filename);
		return in_array($ext, ['jpg', 'jpeg', 'gif', 'png', 'bmp', 'ico']);
	}

/**
 * 获取文件扩展名
 *
 * @param string $filename 文件名
 * @return string
 */
	public function getFileExt($filename) {
		return strtolower(pathinfo($filename, PATHINFO_EXTENSION));
	}
}

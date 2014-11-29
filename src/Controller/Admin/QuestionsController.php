<?php
/**
 * 常见问题管理控制器
 *
 * @copyright LeeAdmin
 * @license   MIT License (http://www.opensource.org/licenses/mit-license.php)
 * @author    Will.Lee <im.will.lee@gmail.com>
 * @package   App.Controller.Admin
 */
namespace App\Controller\Admin;

use App\Controller\AppAdminController;
use Cake\Core\Configure;

class QuestionsController extends AppAdminController {

/**
 * 主标题
 *
 * @var string
 */
	protected $_mainTitle = '常见问题管理';

/**
 * 分类一览
 *
 * @return void
 */
	public function category() {
		$this->_subTitle = '分类一览';
	}

/**
 * 分类添加
 *
 * @return void
 */
	public function category_edit() {
		$this->_subTitle = '分类添加';
	}

/**
 * 分类删除
 *
 * @return void
 */
	public function category_delete() {
		$this->_subTitle = '分类删除';
	}

/**
 * 问题一览
 *
 * @return void
 */
	public function index() {
		$this->_subTitle = '问题一览';
	}

/**
 * 问题添加(编辑)
 *
 * @return void
 */
	public function edit() {
		$this->_subTitle = '问题添加';
	}

/**
 * 问题删除
 *
 * @return void
 */
	public function delete() {
	}
}

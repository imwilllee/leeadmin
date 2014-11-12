<?php
/**
 * 文章分类管理控制器
 *
 * @copyright LeeAdmin
 * @license   MIT License (http://www.opensource.org/licenses/mit-license.php)
 * @author    Will.Lee <im.will.lee@gmail.com>
 * @package   App.Controller.Admin
 */
namespace App\Controller\Admin;

use App\Controller\AppAdminController;
use Cake\Core\Configure;
use Cake\Network\Exception\NotFoundException;

class ArticleCategoriesController extends AppAdminController {

/**
 * 主标题
 *
 * @var string
 */
	protected $_mainTitle = '文章分类管理';

/**
 * 分类一览
 *
 * @return void
 */
	public function index() {
		$this->_subTitle = '分类一览';
		$categories = [];
		$this->set(compact('categories'));
	}

/**
 * 添加分类
 *
 * @param int $id 分类id
 * @return void
 */
	public function add($id = null) {
		$this->_subTitle = '添加分类';
	}

/**
 * 分类编辑
 *
 * @param int $id 分类id
 * @return void
 */
	public function edit($id = null) {
		$this->_subTitle = '分类编辑';
	}

/**
 * 分类删除
 *
 * @param int $id 分类id
 * @return void
 */
	public function delete($id = null) {
	}

/**
 * 分类排序
 *
 * @param int $id 分类id
 * @param string $action 动作
 * @return void
 */
	public function rank($id = null, $action = 'up') {
	}
}

<?php
/**
 * 管理端控制面板控制器
 *
 * @copyright LeeAdmin
 * @license   MIT License (http://www.opensource.org/licenses/mit-license.php)
 * @author    Will.Lee <im.will.lee@gmail.com>
 * @package   App.Controller.Admin
 */
namespace App\Controller\Admin;

use App\Controller\AppAdminController;
use Cake\Core\Configure;
use Cake\ORM\TableRegistry;

class DashboardController extends AppAdminController {

/**
 * 主标题
 * 
 * @var string
 */
	protected $_mainTitle = '控制面板';

/**
 * 用户管理
 * 
 * @return void
 */
	public function index() {
	}

}

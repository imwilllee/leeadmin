<?php
/**
 * 项目控制器基础
 *
 * @copyright LeeAdmin
 * @license   MIT License (http://www.opensource.org/licenses/mit-license.php)
 * @author    Will.Lee <im.will.lee@gmail.com>
 * @package   App.Controller
 */
namespace App\Controller;

use Cake\Controller\Controller;

class AppController extends Controller {

/**
 * 视图类
 * 
 * @var string
 */
	public $viewClass = 'App\View\View';

/**
 * 加载组件
 * 
 * @var array
 */
	public $components = ['Flash'];
}

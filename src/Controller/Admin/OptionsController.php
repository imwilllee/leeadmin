<?php
/**
 * 系统设置控制器
 *
 * @copyright LeeAdmin
 * @license   MIT License (http://www.opensource.org/licenses/mit-license.php)
 * @author    Will.Lee <im.will.lee@gmail.com>
 * @package   App.Controller.Admin
 */
namespace App\Controller\Admin;

use App\Controller\AppAdminController;
use Cake\Core\Configure;

class OptionsController extends AppAdminController {

/**
 * 主标题
 *
 * @var string
 */
	protected $_mainTitle = '系统设置';

/**
 * 站点信息
 *
 * @return void
 */
	public function index() {
		$this->_subTitle = '站点信息';
		$this->loadModel('Options');
		$typeId = Configure::read('Common.options.index');
		$options = $this->Options->getOptionsByTypeId($typeId);
		if ($this->request->is('post')) {
			$options = $this->Options->patchEntity($options, $this->request->data());
			if ($this->Options->validate($options, ['validate' => 'index'])) {
				if ($this->Options->saveOptions($options, $typeId)) {
					$this->Flash->success('数据保存成功！');
					return $this->redirect(['action' => 'index']);
				}
			}
			$this->Flash->error('数据保存失败！');
		}
		$this->set(compact('options'));
	}
}

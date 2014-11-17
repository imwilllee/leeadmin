<?php
/**
 * 附件管理控制器
 *
 * @copyright LeeAdmin
 * @license   MIT License (http://www.opensource.org/licenses/mit-license.php)
 * @author    Will.Lee <im.will.lee@gmail.com>
 * @package   App.Controller.Admin
 */
namespace App\Controller\Admin;

use App\Controller\AppAdminController;
use App\Utility\FileUpload;
use Cake\Core\Configure;
use Cake\Event\Event;

class AttachmentsController extends AppAdminController {

/**
 * 主标题
 *
 * @var string
 */
	protected $_mainTitle = '附件管理';

/**
 * 不需要安全验证的操作
 *
 * @var array
 */
	protected $_allowedActions = ['upload'];

/**
 * 控制器操作执行前回调方法
 *
 * @param Cake\Event\Event $event 事件对象
 * @return void
 */
	public function beforeFilter(Event $event) {
		parent::beforeFilter($event);
	}

/**
 * 附件一览
 *
 * @param string $type 类型
 * @return void
 */
	public function index($type = 'file') {
		$this->_subTitle = '附件一览';
		if ($this->request->query('CKEditor')) {
			$this->layout = 'popup';
		}
	}

/**
 * 上传附件
 *
 * @param string $type 类型
 * @return void
 */
	public function upload($type = 'file') {
		$this->_subTitle = '上传附件';
		if ($this->request->is('post')) {
			$this->autoRender = false;
			if (!in_array($type, array_keys(Configure::read('Attachments')))) {
				$type = 'file';
			}
			$options = Configure::read('Attachments.' . $type);
			$options['param_name'] = 'upload';
			$upload = new FileUpload($options);
			$files = $upload->saveFiles();
			if ($this->request->query('CKEditor')) {
				$this->response->body($this->__responseCKEditor($files['files'][0]));
				$this->response->type('html');
			} else {
				$this->response->body(json_encode($files));
				$this->response->type('json');
			}
			return $this->response;
		}
	}

/**
 * CKEditor文件上传结果返回
 *
 * @param stdClass $file 上传文件信息
 * @return string
 */
	private function __responseCKEditor($file) {
		$error = $previewUrl = '';
		if ($file->error) {
			$error = $file->error;
		} else {
			$previewUrl = $file->previewUrl;
		}
		return sprintf(
			"<script>window.parent.CKEDITOR.tools.callFunction(%s, '%s', '%s');</script>",
			$this->request->query('CKEditorFuncNum'),
			$previewUrl,
			$error
		);
	}
}

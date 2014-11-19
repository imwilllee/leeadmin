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
 * @return void
 */
	public function index() {
		$this->_subTitle = '附件一览';
		$type = $this->request->query('type');
		$this->loadModel('Attachments');
		$query = $this->Attachments->find()->select(['id', 'name', 'size', 'type', 'save_name', 'preview_url', 'is_image', 'created']);
		switch ($type) {
			case 'image':
				$query->where(['is_image' => true]);
				break;
			case 'flash':
				$query->where(['ext' => 'swf']);
				break;
			case 'pdf':
				$query->where(['ext' => 'pdf']);
				break;
			case 'zip':
				$query->where(['ext' => 'zip']);
				break;
			default:
				break;
		}
		$query->order(['id' => 'DESC']);
		$this->paginate = array_merge($this->paginate, ['sortWhitelist' => ['id']]);
		$attachments = $this->paginate($query);
		$this->set(compact('type', 'attachments'));
		if ($this->request->query('CKEditor')) {
			$this->layout = 'popup';
			$this->render('browse');
		}
	}

/**
 * 附件删除
 *
 * @param int $id 栏目id
 * @return void
 */
	public function delete($id = null) {
		$this->request->allowMethod('post', 'delete');
		$this->loadModel('Attachments');
		$attachment = $this->Attachments->get($id);
		if ($this->Attachments->delete($attachment)) {
			// 删除物理文件
			unlink(ROOT . $attachment->save_dir . $attachment->save_name);
			$this->Flash->success('附件删除成功！');
		} else {
			$this->Flash->error('附件删除失败！');
		}
		return $this->redirect(['action' => 'index']);
	}

/**
 * 上传附件
 *
 * @param string $type 类型
 * @return void
 */
	public function upload($type = null) {
		$this->_subTitle = '上传附件';
		if (!$type || !in_array($type, array_keys(Configure::read('Attachments')))) {
			$type = 'file';
		}
		$options = Configure::read('Attachments.' . $type);
		if ($this->request->is('post')) {
			$this->autoRender = false;
			$options['param_name'] = 'upload';
			$upload = new FileUpload($options);
			$files = $upload->saveFiles();
			if ($files['files']) {
				$this->loadModel('Attachments');
				// 保存附件信息
				foreach ($files['files'] as $file) {
					if (!$file->error) {
						$attachment = $this->Attachments->newEntity([
							'hash' => $file->hash,
							'name' => $file->name,
							'size' => $file->size,
							'type' => $file->type,
							'ext' => $file->ext,
							'save_dir' => substr($options['upload_dir'], strlen(ROOT)),
							'save_name' => $file->saveName,
							'preview_url' => $file->previewUrl,
							'is_image' => $file->isImage
						]);
						$this->Attachments->save($attachment, ['validate' => false]);
					}
				}
			}
			if ($this->request->query('CKEditor')) {
				$this->response->body($this->__responseCKEditor($files['files'][0]));
				$this->response->type('html');
			} else {
				$this->response->body(json_encode($files));
				$this->response->type('json');
			}
			return $this->response;
		}
		$this->set(compact('type', 'options'));
		if ($this->request->query('CKEditor')) {
			$this->layout = 'popup';
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

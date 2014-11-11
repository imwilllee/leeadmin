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

class AttachmentsController extends AppAdminController {

/**
 * 主标题
 *
 * @var string
 */
	protected $_mainTitle = '附件管理';

/**
 * 附件一览
 *
 * @return void
 */
	public function index() {
		$this->_subTitle = '附件一览';
	}

/**
 * 上传附件
 *
 * @return void
 */
	public function upload() {
		$this->_subTitle = '上传附件';
		if ($this->request->is('post')) {
			$options = [
				//'upload_dir' => UPLOAD_DIR,
				//'save_rule' => 'logo',
				// 'accept_file_types' => '/\.(gif|jpe?g|png)$/i',
				'param_name' => 'files',
				//'image_versions' => [],
				'max_file_size' => 10 * 1024 * 1024,
				'thumbnail_rule' => [
					// 'big_340' => [
					// 	'max_width' => 340,
					// 	// 最大高度
					// 	'max_height' => 340,
					// 	'suffix' => '_340x340'
					// ],
					// 'small' => [
					// 	'upload_dir' => UPLOAD_DIR,
					// 	'max_width' => 120,
					// 	// 最大高度
					// 	'max_height' => 120,
					// 	'prefix' => '120x120_'
					// ]
				]
			];
			$upload = new FileUpload($options);
			pr($upload->saveFiles());
		}
	}
}

<?php
/**
 * NotFound异常
 *
 * @copyright LeeAdmin
 * @license   MIT License (http://www.opensource.org/licenses/mit-license.php)
 * @author    Will.Lee <im.will.lee@gmail.com>
 * @package   App.Controller.Admin
 */
namespace App\Error\Exception;

use Cake\Network\Exception\HttpException;

class DataNotFoundException extends HttpException {

/**
 * 构造函数
 *
 * @param string $message 异常信息
 * @param int $code 状态码
 */
	public function __construct($message = null, $code = 404) {
		if (empty($message)) {
			$message = 'Not Found';
		}
		parent::__construct($message, $code);
	}

}

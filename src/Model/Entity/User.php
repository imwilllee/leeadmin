<?php
/**
 * 用户表实体
 *
 * @copyright LeeAdmin
 * @license   MIT License (http://www.opensource.org/licenses/mit-license.php)
 * @author    Will.Lee <im.will.lee@gmail.com>
 * @package   App.Model.Entity
 */
namespace App\Model\Entity;

use App\Model\Entity\AppEntity;
use Cake\Auth\DefaultPasswordHasher;

class User extends AppEntity {

/**
 * 密码加密
 *
 * @param string $password 未加密密码
 * @return string
 */
	protected function _setPassword($password) {
		return (new DefaultPasswordHasher)->hash($password);
	}
}

<?php
/**
 * 分组表实体
 *
 * @copyright LeeAdmin
 * @license   MIT License (http://www.opensource.org/licenses/mit-license.php)
 * @author    Will.Lee <im.will.lee@gmail.com>
 * @package   App.Model.Entity
 */
namespace App\Model\Entity;

use App\Model\Entity\AppEntity;

class Group extends AppEntity {

/**
 * 允许访问字段
 *
 * @var array
 */
	protected $_accessible = [
		'name' => true,
		'status' => true,
		'explain' => true,
		'created_by' => true,
		'updated_by' => true,
		'group_accesses' => true,
	];

}

<?php
/**
 * 重载路由过滤器
 * 增加默认路由前缀
 *
 * @copyright LeeAdmin
 * @license   MIT License (http://www.opensource.org/licenses/mit-license.php)
 * @author    Will.Lee <im.will.lee@gmail.com>
 * @package   App.Routing.Filer
 */
namespace App\Routing\Filter;

use Cake\Event\Event;
use Cake\Routing\Filter;

class RoutingFilter extends Filter\RoutingFilter {

/**
 * 路由调度处理
 *
 * @param \Cake\Event\Event $event 事件对象
 * @return void
 */
	public function beforeDispatch(Event $event) {
		parent::beforeDispatch($event);
		// 默认路由前缀设置
		if (empty($event->data['request']->params['prefix']) && $event->data['request']->params['plugin'] != 'DebugKit') {
			$event->data['request']->params['prefix'] = 'front';
		}
	}

}

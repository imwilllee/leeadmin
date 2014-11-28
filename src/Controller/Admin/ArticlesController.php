<?php
/**
 * 文章管理控制器
 *
 * @copyright LeeAdmin
 * @license   MIT License (http://www.opensource.org/licenses/mit-license.php)
 * @author    Will.Lee <im.will.lee@gmail.com>
 * @package   App.Controller.Admin
 */
namespace App\Controller\Admin;

use App\Controller\AppAdminController;
use Cake\Core\Configure;
use Cake\ORM\Exception\RecordNotFoundException;
use Cake\Utility\Inflector;
use DateTime;
use InvalidArgumentException;

class ArticlesController extends AppAdminController {

/**
 * 主标题
 *
 * @var string
 */
	protected $_mainTitle = '文章管理';

/**
 * 文章一览
 *
 * @return void
 */
	public function index() {
		$this->_subTitle = '文章一览';
		$this->loadModel('Articles');
		$this->loadModel('Channels');
		$query = $this->Articles->find()->select([
				'Articles.id',
				'Articles.title',
				'Articles.channel_id',
				'Articles.is_delete',
				'Articles.status',
				'Articles.recommend_flg',
				'Articles.hot_flg',
				'Articles.new_flg',
				'Articles.created',
				'Channels.name'
			])
			->contain(['Channels']);
		$this->__markQuery($query);
		$config = [
			'sortWhitelist' => [
				'Articles.status',
				'Articles.channel_id',
				'Articles.created'
			],
			'limit' => 15
		];
		$this->paginate = array_merge($this->paginate, $config);
		$articles = $this->paginate($query);

		$channelsTree = $this->Channels->find('children', ['for' => 1])->select(['id', 'parent_id', 'name']);
		$this->set(compact('articles', 'channelsTree'));
	}

/**
 * 组装查询条件
 *
 * @param Cake\ORM\Query $query 查询生成器
 * @return void
 */
	private function __markQuery($query) {
		if ($this->request->is('post')) {
			if ($this->request->data('title') != '') {
				$this->request->query['title'] = urlencode($this->request->data('title'));
			}
			if ($this->request->data('channel_id') != '') {
				$this->request->query['channel_id'] = $this->request->data('channel_id');
			}
			if ($this->request->data('status') != '') {
				$this->request->query['status'] = implode('_', $this->request->data('status'));
			}
			if ($this->request->data('recommend_flg')) {
				$this->request->query['recommend_flg'] = $this->request->data('recommend_flg');
			}
			if ($this->request->data('hot_flg')) {
				$this->request->query['hot_flg'] = $this->request->data('hot_flg');
			}
			if ($this->request->data('new_flg')) {
				$this->request->query['new_flg'] = $this->request->data('new_flg');
			}
			if ($this->request->data('start_date') != '') {
				$this->request->query['start_date'] = urlencode($this->request->data('start_date'));
			}
			if ($this->request->data('end_date') != '') {
				$this->request->query['end_date'] = urlencode($this->request->data('end_date'));
			}
		}

		if ($this->request->query('title') != '') {
			$title = urldecode($this->request->query('title'));
			$query->where(['Articles.title LIKE' => '%' . $title . '%']);
			$this->request->data['title'] = $title;
		}
		if ($this->request->query('channel_id') != '') {
			$this->request->data['channel_id'] = $this->request->query('channel_id');
			$channels = [$this->request->data['channel_id']];
			$childrenChannels = $this->Channels->find('children', ['for' => $this->request->data['channel_id']])->find('list', ['idField' => 'id', 'valueField' => 'id'])->toArray();
			if (!empty($childrenChannels)) {
				$channels = array_merge($channels, $childrenChannels);
			}
			$query->where(['Articles.channel_id IN' => $channels]);
		}
		if ($this->request->query('status') != '') {
			$this->request->data['status'] = explode('_', $this->request->query('status'));
			if (!empty($this->request->data['status'])) {
				$query->where(['Articles.status IN' => $this->request->data['status']]);
			}
		}
		if ($this->request->query('recommend_flg')) {
			$this->request->data['recommend_flg'] = $this->request->query('recommend_flg');
			$query->where(['Articles.recommend_flg' => true]);
		}
		if ($this->request->query('hot_flg')) {
			$this->request->data['hot_flg'] = $this->request->query('hot_flg');
			$query->where(['Articles.hot_flg' => true]);
		}
		if ($this->request->query('new_flg')) {
			$this->request->data['new_flg'] = $this->request->query('new_flg');
			$query->where(['Articles.new_flg' => true]);
		}
		if ($this->request->query('start_date') != '') {
			$this->request->data['start_date'] = urldecode($this->request->query('start_date'));
			$query->andWhere(function ($exp) {
				return $exp->gte('Articles.created', $this->request->data['start_date']);
			});
		}
		if ($this->request->query('end_date') != '') {
			$this->request->data['end_date'] = urldecode($this->request->query('end_date'));
			$query->andWhere(function ($exp) {
				return $exp->lte('Articles.created', $this->request->data['end_date']);
			});
		}

		if (!$this->request->query('sort')) {
			$query->order(['Articles.created' => 'DESC']);
		}
	}

/**
 * 属性更新
 *
 * @param string $action 操作名
 * @return void
 */
	public function attribute($action = null) {
		$this->autoRender = false;
		$ids = $this->request->query('id');
		if (empty($ids)) {
			$this->Flash->error('请至少选择一个项目！');
		} else {
			$ids = explode('_', $ids);
			$update = [
				'modified' => new DateTime('now'),
				'modified_by' => $this->request->session()->read('Auth.User.id')
			];
			switch ($action) {
				case 'draft':
					$update['status'] = false;
					break;
				case 'public':
					$update['status'] = true;
					break;
				case 'recommend':
					$update['recommend_flg'] = true;
					break;
				case 'unrecommend':
					$update['recommend_flg'] = false;
					break;
				case 'hot':
					$update['hot_flg'] = true;
					break;
				case 'unhot':
					$update['hot_flg'] = false;
					break;
				case 'new':
					$update['new_flg'] = true;
					break;
				case 'unnew':
					$update['new_flg'] = false;
					break;
				default:
					break;
			}
			$this->loadModel('Articles');
			$query = $this->Articles->query();
			$result = $query->update()->set($update)->where(['id IN' => $ids])->execute();
			if ($result) {
				$this->Flash->success('数据更新成功！');
			} else {
				$this->Flash->error('数据更新失败');
			}
		}
		return $this->redirect(['action' => 'index', '?' => ['channel_id' => $this->request->query('channel_id')]]);
	}

/**
 * 添加文章
 *
 * @param int channelId 栏目ID
 * @return void
 */
	public function add($channelId = null) {
		$this->_subTitle = '添加文章';
		$this->loadModel('Channels');
		$this->loadModel('Articles');
		try {
			$channel = $this->Channels->get($channelId);
		} catch (RecordNotFoundException $e) {
			return $this->redirect(['action' => 'index']);
		} catch (InvalidArgumentException $e) {
			return $this->redirect(['action' => 'index']);
		}
		$article = $this->Articles->newEntity($this->request->data());
		if ($this->request->is('post')) {
			$options = [];
			if ($channel->type_id == 2) {
				$options = ['validate' => 'pages'];
			}
			if ($this->Articles->save($article, $options)) {
				$this->Flash->success('数据保存成功！');
				return $this->redirect(['action' => 'index', '?' => ['channel_id' => $channel->id]]);
			} else {
				$this->Flash->error('数据保存失败！');
			}
		} else {
			$article->set('channel_id', $channelId);
		}
		$breadcrumbs = $this->Channels->find('path', ['for' => $channelId])->select(['id', 'name']);
		if ($channel->type_id == 2) {
			$this->_subTitle = '添加单页';
		}
		$this->set(compact('channel', 'article', 'breadcrumbs'));
	}

/**
 * 文章编辑
 *
 * @param int $id 文章ID
 * @return void
 */
	public function edit($id = null) {
		$this->_subTitle = '文章编辑';
		$this->loadModel('Articles');
		$this->loadModel('Channels');
		$article = $this->Articles->get($id, ['contain' => ['Channels']]);
		if ($this->request->is(['post', 'put'])) {
			$options = [];
			if ($article->channel->type_id == 2) {
				$options = ['validate' => 'pages'];
			}
			$article = $this->Articles->patchEntity($article, $this->request->data());
			if ($this->Articles->save($article, $options)) {
				$this->Flash->success('数据保存成功！');
				return $this->redirect(['action' => 'index', '?' => ['channel_id' => $article->channel_id]]);
			} else {
				$this->Flash->error('数据保存失败！');
			}
		}
		$breadcrumbs = $this->Channels->find('path', ['for' => $article->channel->id])->select(['id', 'name']);
		if ($article->channel->type_id == 2) {
			$this->_subTitle = '单页编辑';
		}
		$this->set(compact('article', 'breadcrumbs'));
	}

/**
 * 删除文章
 *
 * @param int $id 文章ID
 * @return void
 */
	public function delete($id = null) {
		$this->request->allowMethod('post', 'delete');
		$this->loadModel('Articles');
		$article = $this->Articles->get($id, ['contain' => false]);
		if ($article->is_delete) {
			if ($this->Articles->delete($article)) {
				$this->Flash->success('数据删除成功！');
			} else {
				$this->Flash->error('数据删除失败！');
			}
		} else {
			$this->Flash->error('该文章不可删除！');
		}
		return $this->redirect(['action' => 'index']);
	}
}

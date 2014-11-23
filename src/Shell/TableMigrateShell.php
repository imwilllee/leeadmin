<?php
namespace App\Shell;

use Cake\Console\Shell;

class TableMigrateShell extends Shell {

	public function main() {
		$this->loadModel('BaseChannels');
		$this->loadModel('Channels');
		$this->loadModel('Articles');
		$rootChannels = $this->BaseChannels->find()->contain(['BaseArticles'])
				->where(['parent_id' => 0]);

		foreach ($rootChannels as $root) {
			$channel = $this->Channels->newEntity([
					'parent_id' => 1,
					'type_id' => $root->type,
					'name' => $root->name,
					'level' => 0,
					'content' => $root->content,
					'is_core' => true,
					'display_flg' => true,
					'seo_keywords' => $root->keywords,
					'seo_description' => $root->description
				]);
			$this->Channels->save($channel, ['validate' => false]);

			if ($root->articles) {
				foreach ($root->articles as $baseArticle) {
					$article = $this->Articles->newEntity([
							'title' => $baseArticle->title,
							'channel_id' => $channel->id,
							'recommend_flg' => $baseArticle->flag == 'r' ? true : false,
							'thumbnail' => $baseArticle->litpic,
							'content' => $baseArticle->content,
							'rank' => $baseArticle->sort,
							'seo_keywords' => $baseArticle->keywords,
							'seo_description' => $baseArticle->description,
							'created' => date('Y-m-d H:i:s', $baseArticle->posttime)
						]);
					$this->Articles->save($article, ['validate' => false]);
				}
			}
			$this->_migrateChildChannels($root->id, $channel->id);
		}

		$channels = $this->Channels->find('children', ['for' => 1]);
		foreach ($channels as $channel) {
			$paths = $this->Channels->find('path', ['for' => $channel->id])->count();
			$level = $paths - 2;
			$query = $this->Channels->query();
			$query->update()
				->set([
					'level' => $level
				])
				->where(['id' => $channel->id])
				->execute();
		}

		$this->out('channels and articles migrate success!');
	}

/**
 * 迁移子栏目
 *
 * @param int $sourceParentId 源栏目ID
 * @param int $parentId 新栏目ID
 * @return boolean
 */
	protected function _migrateChildChannels($sourceParentId, $parentId) {
		$sourceChannels = $this->BaseChannels->find()->contain(['BaseArticles'])->where(['parent_id' => $sourceParentId]);
		foreach ($sourceChannels as $source) {
			$sourceChannel = $this->Channels->newEntity([
					'parent_id' => $parentId,
					'type_id' => $source->type,
					'name' => $source->name,
					'level' => 1,
					'content' => $source->content,
					'is_core' => true,
					'display_flg' => true,
					'seo_keywords' => $source->keywords,
					'seo_description' => $source->description
				]);

			$this->Channels->save($sourceChannel, ['validate' => false]);
			if ($source->articles) {
				foreach ($source->articles as $article) {
					$childArticle = $this->Articles->newEntity([
							'title' => $article->title,
							'channel_id' => $sourceChannel->id,
							'recommend_flg' => $article->flag == 'r' ? true : false,
							'thumbnail' => $article->litpic,
							'content' => $article->content,
							'rank' => $article->sort,
							'seo_keywords' => $article->keywords,
							'seo_description' => $article->description,
							'created' => date('Y-m-d H:i:s', $article->posttime)
						]);
					$this->Articles->save($childArticle, ['validate' => false]);
				}
			}
			$this->_migrateChildChannels($source->id, $sourceChannel->id);
		}
	}
}

<?php
namespace App\Shell;

use Cake\Console\Shell;

class TableMigrateShell extends Shell {

	public function main() {
		$this->loadModel('BaseChannels');
		$this->loadModel('Channels');
		$rootChannels = $this->BaseChannels->find()->contain(['BaseArticles'])
				->where(function ($exp) {
					$exp->isNull('parent_id');
					return $exp;
				});

		foreach ($rootChannels as $root) {
			$channel = $this->Channels->newEntity([
					'parent_id' => 1,
					'type_id' => $root->type,
					'name' => $root->name,
					'level' => 0,
					'is_core' => $root->is_system
				]);
			$this->Channels->save($channel, ['validate' => false]);
			$baseChannels = $this->BaseChannels->find('children', ['for' => $root->id])->contain(['BaseArticles']);
			foreach ($baseChannels as $base) {

			}
		}
	}
}

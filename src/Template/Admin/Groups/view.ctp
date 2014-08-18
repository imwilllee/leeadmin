<div class="groups view">
	<h2><?= __('Group'); ?></h2>
	<dl>
		<dt><?= __('Id'); ?></dt>
		<dd>
			<?= h($group->id); ?>
			&nbsp;
		</dd>
		<dt><?= __('Name'); ?></dt>
		<dd>
			<?= h($group->name); ?>
			&nbsp;
		</dd>
		<dt><?= __('Status'); ?></dt>
		<dd>
			<?= h($group->status); ?>
			&nbsp;
		</dd>
		<dt><?= __('Explain'); ?></dt>
		<dd>
			<?= h($group->explain); ?>
			&nbsp;
		</dd>
		<dt><?= __('Created'); ?></dt>
		<dd>
			<?= h($group->created); ?>
			&nbsp;
		</dd>
		<dt><?= __('Created By'); ?></dt>
		<dd>
			<?= h($group->created_by); ?>
			&nbsp;
		</dd>
		<dt><?= __('Updated'); ?></dt>
		<dd>
			<?= h($group->updated); ?>
			&nbsp;
		</dd>
		<dt><?= __('Updated By'); ?></dt>
		<dd>
			<?= h($group->updated_by); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?= __('Actions'); ?></h3>
	<ul>
		<li><?= $this->Html->link(__('Edit Group'), ['action' => 'edit', $group->id]); ?> </li>
		<li><?= $this->Form->postLink(__('Delete Group'), ['action' => 'delete', $group->id], ['confirm' => __('Are you sure you want to delete # %s?', $group->id)]); ?> </li>
		<li><?= $this->Html->link(__('List Groups'), ['action' => 'index']); ?> </li>
		<li><?= $this->Html->link(__('New Group'), ['action' => 'add']); ?> </li>
	</ul>
</div>


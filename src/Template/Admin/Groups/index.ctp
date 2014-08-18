<div class="groups index">
	<h2><?= __('Groups'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
		<th><?= $this->Paginator->sort('id'); ?></th>
		<th><?= $this->Paginator->sort('name'); ?></th>
		<th><?= $this->Paginator->sort('status'); ?></th>
		<th><?= $this->Paginator->sort('explain'); ?></th>
		<th><?= $this->Paginator->sort('created'); ?></th>
		<th><?= $this->Paginator->sort('created_by'); ?></th>
		<th><?= $this->Paginator->sort('updated'); ?></th>
		<th><?= $this->Paginator->sort('updated_by'); ?></th>
		<th class="actions"><?= __('Actions'); ?></th>
	</tr>
	<?php foreach ($groups as $group): ?>
	<tr>
		<td><?= h($group->id); ?>&nbsp;</td>
		<td><?= h($group->name); ?>&nbsp;</td>
		<td><?= h($group->status); ?>&nbsp;</td>
		<td><?= h($group->explain); ?>&nbsp;</td>
		<td><?= h($group->created); ?>&nbsp;</td>
		<td><?= h($group->created_by); ?>&nbsp;</td>
		<td><?= h($group->updated); ?>&nbsp;</td>
		<td><?= h($group->updated_by); ?>&nbsp;</td>
		<td class="actions">
			<?= $this->Html->link(__('View'), ['action' => 'view', $group->id]); ?>
			<?= $this->Html->link(__('Edit'), ['action' => 'edit', $group->id]); ?>
			<?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $group->id], ['confirm' => __('Are you sure you want to delete # %s?', $group->id)]); ?>
		</td>
	</tr>
	<?php endforeach; ?>
	</table>
	<p><?= $this->Paginator->counter(); ?></p>
	<ul class="pagination">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'));
		echo $this->Paginator->numbers();
		echo $this->Paginator->next(__('next') . ' >');
	?>
	</ul>
</div>
<div class="actions">
	<h3><?= __('Actions'); ?></h3>
	<ul>
		<li><?= $this->Html->link(__('New Group'), ['action' => 'add']); ?></li>
	</ul>
</div>

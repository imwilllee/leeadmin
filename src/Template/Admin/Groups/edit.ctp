<div class="groups form">
<?= $this->Form->create($group); ?>
	<fieldset>
		<legend><?= __('Edit Group'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name');
		echo $this->Form->input('status');
		echo $this->Form->input('explain');
		echo $this->Form->input('created_by');
		echo $this->Form->input('updated_by');
	?>
	</fieldset>
<?= $this->Form->button(__('Submit')); ?>
<?= $this->Form->end(); ?>
</div>
<div class="actions">
	<h3><?= __('Actions'); ?></h3>
	<ul>
		<li><?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $group->id], ['confirm' => __('Are you sure you want to delete # %s?', $group->id)]); ?></li>
		<li><?= $this->Html->link(__('List Groups'), ['action' => 'index']); ?></li>
	</ul>
</div>

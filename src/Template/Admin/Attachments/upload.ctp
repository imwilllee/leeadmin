<?php echo $this->Form->create(null, ['type' => 'file']); ?>
<?php echo $this->Form->unlockField('files'); ?>
<?php echo $this->Form->file('upload[]', ['multiple' => true] ); ?>
<?php echo $this->Form->submit(); ?>
<?php echo $this->Form->end(); ?>

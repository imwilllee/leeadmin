<div class="row">
    <div class="col-md-12">
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li><?php echo $this->Html->link('附件一览', ['action' => 'index', '?' => $this->request->query]); ?></li>
                <li class="active"><a href="javascript:;">上传附件</a></li>

            </ul>
            <div class="tab-content">
                <div class="tab-pane active">
                    <div class="box box-primary">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-lg-12">
<?php echo $this->Form->create(null, ['type' => 'file']); ?>
<?php echo $this->Form->unlockField('files'); ?>
<?php echo $this->Form->file('upload[]', ['multiple' => true] ); ?>
<?php echo $this->Form->submit(); ?>
<?php echo $this->Form->end(); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>




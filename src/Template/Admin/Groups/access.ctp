<?php
    use Cake\Core\Configure;
?>
<div class="row">
    <div class="col-md-12">
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li><?php echo $this->Html->link('基本信息', ['action' => 'edit', $group->id]); ?></li>
                <li class="active"><a href="javascript:;">访问权限</a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active">

                <?php echo $this->Form->create($group); ?>
                    <div class="box box-solid box-primary">
                        <div class="box-header">
                            <h3 class="box-title">权限设置</h3>
                        </div>
                        <div class="box-body">

                        </div>
                        <div class="box-footer">
                            <?php echo $this->Html->link('返回一览', ['action' => 'index'], ['class' => 'btn btn-default btn-flat']); ?>
                            <button class="btn btn-primary btn-flat">确认保存</button>
                        </div>
                    </div>
                <?php echo $this->Form->end(); ?>

                </div>
            </div>
        </div>
    </div>
</div>

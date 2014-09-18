<?php
    use Cake\Core\Configure;
?>
<div class="row">
    <div class="col-md-12">
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li class="active"><a href="javascript:;">基本信息</a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active">

                <?php echo $this->Form->create($group); ?>
                    <div class="box box-solid box-primary">
                        <div class="box-header">
                            <h3 class="box-title">用户组信息</h3>
                        </div>
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-4 col-xs-12">
                                    <div class="form-group<?php echo $this->Admin->errorClass('name'); ?>">
                                        <label>用户组名称</label>
                                        <?php echo $this->Form->text('name', ['class' => 'form-control', 'placeholder' => '用户组名称']); ?>
                                        <?php echo $this->Admin->error('name'); ?>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4 col-xs-12">
                                    <div class="form-group<?php echo $this->Admin->errorClass('status'); ?>">
                                        <label>状态</label>
                                        <div class="input-group">
                                            <div class="checkbox">
                                                <?php echo $this->Form->checkbox('status', ['id' => 'status']); ?><label for="status">启用</label>
                                            </div>
                                        </div>
                                        <span class="text-light-blue">启用后，所属该用户组下的用户才能正常登录。</span>
                                        <?php echo $this->Admin->error('status'); ?>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4 col-xs-12">
                                    <div class="form-group<?php echo $this->Admin->errorClass('explain'); ?>">
                                        <label>备注说明</label>
                                        <?php
                                            echo $this->Form->textarea(
                                                'explain',
                                                [
                                                    'class' => 'form-control',
                                                    'placeholder' => '备注说明',
                                                    'rows' => 5
                                                ]
                                            );
                                        ?>
                                        <?php echo $this->Admin->error('explain'); ?>
                                    </div>
                                </div>
                            </div>

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

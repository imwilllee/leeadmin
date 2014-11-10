<?php
    use Cake\Core\Configure;
?>
<div class="row">
    <div class="col-md-12">
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li class="active"><a href="javascript:;">密码修改</a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active">

                <?php echo $this->Form->create($user); ?>
                    <div class="box box-solid box-primary">
                        <div class="box-header">
                            <h3 class="box-title">基本信息</h3>
                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-primary btn-xs" data-widget="collapse" data-toggle="tooltip" data-original-title="关闭"><i class="fa fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="box-body">
                            <div class="row">
                                <div class="col-lg-5 col-md-8 col-xs-12">
                                    <div class="form-group<?php echo $this->Admin->errorClass('old_password'); ?>">
                                        <label>原始密码</label>
                                        <?php echo $this->Form->text('old_password', ['class' => 'form-control', 'placeholder' => '原始密码']); ?>
                                        <?php echo $this->Admin->error('old_password'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-5 col-md-8 col-xs-12">
                                    <div class="form-group<?php echo $this->Admin->errorClass('user_password'); ?>">
                                        <label>新密码</label>
                                        <?php echo $this->Form->text('user_password', ['class' => 'form-control', 'placeholder' => '新密码']); ?>
                                        <?php echo $this->Admin->error('user_password'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-5 col-md-8 col-xs-12">
                                    <div class="form-group<?php echo $this->Admin->errorClass('confirm_password'); ?>">
                                        <label>确认新密码</label>
                                        <?php echo $this->Form->text('confirm_password', ['class' => 'form-control', 'placeholder' => '确认新密码']); ?>
                                        <?php echo $this->Admin->error('confirm_password'); ?>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                <?php echo $this->element('Admin/Common/submit_btn'); ?>
                <?php echo $this->Form->end(); ?>

                </div>
            </div>
        </div>
    </div>
</div>

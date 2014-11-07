<?php
    use Cake\Core\Configure;
?>
<div class="row">
    <div class="col-md-12">
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li><?php echo $this->Html->link('管理员一览', ['action' => 'index']); ?></li>
                <li class="active"><a href="javascript:;">创建管理员</a></li>
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
                                    <div class="form-group<?php echo $this->Admin->errorClass('email'); ?>">
                                        <label>邮箱</label>
                                        <?php echo $this->Form->text('email', ['class' => 'form-control', 'placeholder' => '邮箱']); ?>
                                        <span class="text-light-blue">长度在32位内并且唯一不重复。</span>
                                        <?php echo $this->Admin->error('email'); ?>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-5 col-md-8 col-xs-12">
                                    <div class="form-group<?php echo $this->Admin->errorClass('password'); ?>">
                                        <label>密码</label>
                                        <?php echo $this->Form->password('password', ['class' => 'form-control', 'placeholder' => '密码']); ?>
                                        <span class="text-light-blue">长度6-18位，允许英文字母、数字、下划线。</span>
                                        <?php echo $this->Admin->error('password'); ?>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-5 col-md-8 col-xs-12">
                                    <div class="form-group<?php echo $this->Admin->errorClass('confirm_password'); ?>">
                                        <label>确认密码</label>
                                        <?php echo $this->Form->password('confirm_password', ['class' => 'form-control', 'placeholder' => '确认密码']); ?>
                                        <?php echo $this->Admin->error('confirm_password'); ?>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12 col-xs-12">
                                    <div class="form-group<?php echo $this->Admin->errorClass('status'); ?>">
                                        <label>状态</label>
                                        <div class="input-group">
                                            <div class="checkbox">
                                                <?php echo $this->Form->checkbox('status', ['id' => 'status']); ?><label for="status">启用</label>
                                            </div>
                                        </div>
                                        <span class="text-light-blue">启用后才能正常登录。</span>
                                        <?php echo $this->Admin->error('status'); ?>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-3 col-md-5 col-xs-12">
                                    <div class="form-group<?php echo $this->Admin->errorClass('group_id'); ?>">
                                        <label>所属用户组</label>
                                        <?php echo $this->Form->select('group_id', $groupList, ['class' => 'form-control', 'empty' => '选择用户组']); ?>
                                        <?php echo $this->Admin->error('group_id'); ?>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-5 col-md-8 col-xs-12">
                                    <div class="form-group<?php echo $this->Admin->errorClass('alias'); ?>">
                                        <label>昵称</label>
                                        <?php echo $this->Form->text('alias', ['class' => 'form-control', 'placeholder' => '昵称']); ?>
                                        <?php echo $this->Admin->error('alias'); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="box box-solid box-primary">
                        <div class="box-header">
                            <h3 class="box-title">详细信息</h3>
                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-primary btn-xs" data-widget="collapse" data-toggle="tooltip" data-original-title="关闭"><i class="fa fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="box-body">

                            <div class="row">
                                <div class="col-lg-5 col-md-8 col-xs-12">
                                    <div class="form-group<?php echo $this->Admin->errorClass('mobile'); ?>">
                                        <label>手机号码</label>
                                        <?php echo $this->Form->text('mobile', ['class' => 'form-control', 'placeholder' => '手机号码']); ?>
                                        <?php echo $this->Admin->error('mobile'); ?>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-3 col-md-5 col-xs-12">
                                    <div class="form-group<?php echo $this->Admin->errorClass('birth'); ?>">
                                        <label>出生年月</label>
                                        <div class="input-group">
                                            <?php echo $this->Form->text('birth', ['class' => 'form-control', 'placeholder' => '出生年月', 'id' => 'birth']); ?>
                                            <div class="input-group-addon datepicker" data-target-id="birth">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                        </div>
                                        <?php echo $this->Admin->error('birth'); ?>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12 col-xs-12">
                                    <div class="form-group<?php echo $this->Admin->errorClass('sex'); ?>">
                                        <label>性别</label>
                                        <div class="input-group">
                                            <div class="radio">
                                                <?php echo $this->Form->radio('sex', Configure::read('Common.sex'), ['default' => 0]); ?>
                                            </div>
                                        </div>
                                        <?php echo $this->Admin->error('sex'); ?>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-5 col-md-8 col-xs-12">
                                    <div class="form-group<?php echo $this->Admin->errorClass('explain'); ?>">
                                        <label>备注说明</label>
                                        <?php echo $this->Form->textarea('explain', ['class' => 'form-control', 'placeholder' => '备注说明', 'rows' => 5]); ?>
                                        <?php echo $this->Admin->error('explain'); ?>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                <?php echo $this->element('Common/submit_btn'); ?>
                <?php echo $this->Form->end(); ?>

                </div>
            </div>
        </div>
    </div>
</div>

<?php echo $this->element('Common/Plugin/datetimepicker'); ?>

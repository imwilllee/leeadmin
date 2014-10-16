<?php
    use Cake\Core\Configure;
?>
<div class="row">
    <div class="col-md-12">
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li><?php echo $this->Html->link('管理员一览', ['action' => 'index']); ?></li>
                <li><?php echo $this->Html->link('创建管理员', ['action' => 'add']); ?></li>
                <li class="active"><a href="javascript:;">管理员详细</a></li>
                <li><?php echo $this->Html->link('管理员编辑', ['action' => 'edit', $user->id]); ?></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active">
                    <div class="box box-solid box-primary">
                        <div class="box-header">
                            <h3 class="box-title">基本信息</h3>
                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-primary btn-xs" data-widget="collapse" data-toggle="tooltip" data-original-title="关闭"><i class="fa fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="box-body">
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="form-group">
                                        <label>邮箱</label>
                                        <p><?php echo h($user->email); ?></p>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="form-group">
                                        <label>状态</label>
                                        <p>
                                            <?php
                                                if ($user->status) {
                                                    echo Configure::read('Common.status.1');
                                                } else {
                                                    echo Configure::read('Common.status.0');
                                                }
                                            ?>
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="form-group">
                                        <label>所属用户组</label>
                                        <p><?php echo $this->Html->link($user->group->name, ['controller' => 'Groups', 'action' => 'view', $user->group_id]); ?></p>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="form-group">
                                        <label>昵称</label>
                                        <p><?php echo h($user->alias); ?></p>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="form-group">
                                        <label>创建日期</label>
                                        <p><?php echo df($user->created); ?></p>
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
                                <div class="col-xs-12">
                                    <div class="form-group">
                                        <label>手机号码</label>
                                        <p><?php echo $user->mobile; ?></p>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="form-group">
                                        <label>出生年月</label>
                                        <p><?php echo df($user->birth, 'Y-m-d'); ?></p>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="form-group">
                                        <label>性别</label>
                                        <p><?php echo Configure::read('Common.sex.' . $user->sex); ?></p>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="form-group">
                                        <label>备注说明</label>
                                        <p><?php echo nl2br(h($user->explain)); ?></p>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="box box-solid box-primary">
                        <div class="box-header">
                            <h3 class="box-title">登录信息</h3>
                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-primary btn-xs" data-widget="collapse" data-toggle="tooltip" data-original-title="关闭"><i class="fa fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="box-body">
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="form-group">
                                        <label>最后登录日期</label>
                                        <p><?php echo df($user->last_logined); ?></p>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="form-group">
                                        <label>最后登录IP</label>
                                        <p><?php echo h($user->last_login_ip); ?></p>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="form-group">
                                        <label>最后登录终端</label>
                                        <p><?php echo h($user->last_user_agent); ?></p>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <?php echo $this->Html->link('返回一览', ['action' => 'index'], ['class' => 'btn btn-default btn-flat']); ?>
                    <?php echo $this->Html->link('编辑信息', ['action' => 'edit', $user->id], ['class' => 'btn btn-primary btn-flat']); ?>
                </div>
            </div>
        </div>
    </div>
</div>

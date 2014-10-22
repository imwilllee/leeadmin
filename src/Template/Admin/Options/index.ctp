<?php
    use Cake\Core\Configure;
?>
<div class="row">
    <div class="col-md-12">
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li class="active"><a href="javascript:;">站点信息</a></li>
                <li><?php echo $this->Html->link('SEO设置', ['action' => 'seo']); ?></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active">

                <?php echo $this->Form->create($options); ?>

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
                                    <div class="form-group<?php echo $this->Admin->errorClass('title'); ?>">
                                        <label>网站名称</label>
                                        <?php echo $this->Form->text('title', ['class' => 'form-control', 'placeholder' => '网站名称']); ?>
                                        <?php echo $this->Admin->error('title'); ?>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-5 col-md-8 col-xs-12">
                                    <div class="form-group<?php echo $this->Admin->errorClass('domain'); ?>">
                                        <label>网站域名</label>
                                        <?php echo $this->Form->text('domain', ['class' => 'form-control', 'placeholder' => '网站名称']); ?>
                                        <span class="text-light-blue">以“http”或“https”开头，结尾不包含“/”号，留空为当前域名。</span>
                                        <?php echo $this->Admin->error('domain'); ?>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-5 col-md-8 col-xs-12">
                                    <div class="form-group<?php echo $this->Admin->errorClass('email'); ?>">
                                        <label>邮箱地址</label>
                                        <?php echo $this->Form->text('email', ['class' => 'form-control', 'placeholder' => '邮箱地址']); ?>
                                        <?php echo $this->Admin->error('email'); ?>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-5 col-md-8 col-xs-12">
                                    <div class="form-group<?php echo $this->Admin->errorClass('tagline'); ?>">
                                        <label>网站简介</label>
                                        <?php echo $this->Form->textarea('tagline', ['class' => 'form-control', 'placeholder' => '网站简介', 'rows' => 3]); ?>
                                        <?php echo $this->Admin->error('tagline'); ?>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-5 col-md-8 col-xs-12">
                                    <div class="form-group<?php echo $this->Admin->errorClass('icp_no'); ?>">
                                        <label>ICP备案号</label>
                                        <?php echo $this->Form->text('icp_no', ['class' => 'form-control', 'placeholder' => 'ICP备案号']); ?>
                                        <?php echo $this->Admin->error('icp_no'); ?>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-5 col-md-8 col-xs-12">
                                    <div class="form-group<?php echo $this->Admin->errorClass('timezone'); ?>">
                                        <label>时区设置</label>
                                        <?php echo $this->Form->select('timezone', get_time_zone_list(), ['class' => 'form-control selectpicker', 'empty' => '系统默认时区']); ?>
                                        <?php echo $this->Admin->error('timezone'); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="box box-solid box-primary">
                        <div class="box-header">
                            <h3 class="box-title">状态设置</h3>
                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-primary btn-xs" data-widget="collapse" data-toggle="tooltip" data-original-title="关闭"><i class="fa fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="box-body">
                            <div class="row">
                                <div class="col-lg-5 col-md-8 col-xs-12">
                                    <div class="form-group<?php echo $this->Admin->errorClass('run_status'); ?>">
                                        <label>网站运行状态</label>
                                        <div class="input-group">
                                            <div class="radio">
                                                <?php echo $this->Form->radio('run_status', Configure::read('Common.run_status'), ['default' => 0]); ?>
                                            </div>
                                        </div>
                                        <span class="text-light-blue">该设置只针对网站前台访问。</span>
                                        <?php echo $this->Admin->error('run_status'); ?>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-5 col-md-8 col-xs-12">
                                    <div class="form-group<?php echo $this->Admin->errorClass('maintenance_info'); ?>">
                                        <label>维护信息</label>
                                        <?php echo $this->Form->textarea('maintenance_info', ['class' => 'form-control', 'placeholder' => '维护信息', 'rows' => 5]); ?>
                                        <?php echo $this->Admin->error('maintenance_info'); ?>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <button class="btn btn-primary btn-flat">确认保存</button>
                <?php echo $this->Form->end(); ?>

                </div>
            </div>
        </div>
    </div>
</div>

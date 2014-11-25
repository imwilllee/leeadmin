<?php
    use Cake\Core\Configure;
?>
<div class="row">
    <div class="col-md-12">
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li class="active"><a href="javascript:;">站点信息</a></li>
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
                                        <label>网站标题</label>
                                        <?php echo $this->Form->text('title', ['class' => 'form-control', 'placeholder' => '网站名称']); ?>
                                        <?php echo $this->Admin->error('title'); ?>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-8 col-md-8 col-xs-12">
                                    <div class="form-group<?php echo $this->Admin->errorClass('keywords'); ?>">
                                        <label>网站关键字</label>
                                        <?php echo $this->Form->textarea('keywords', ['class' => 'form-control', 'placeholder' => '网站关键字', 'rows' => 5]); ?>
                                        <?php echo $this->Admin->error('keywords'); ?>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-8 col-md-8 col-xs-12">
                                    <div class="form-group<?php echo $this->Admin->errorClass('description'); ?>">
                                        <label>网站描述</label>
                                        <?php echo $this->Form->textarea('description', ['class' => 'form-control', 'placeholder' => '网站描述', 'rows' => 5]); ?>
                                        <?php echo $this->Admin->error('description'); ?>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-8 col-md-8 col-xs-12">
                                    <div class="form-group<?php echo $this->Admin->errorClass('icp_no'); ?>">
                                        <label>ICP备案号</label>
                                        <?php echo $this->Form->textarea('icp_no', ['class' => 'form-control', 'placeholder' => 'ICP备案号', 'rows' => 3]); ?>
                                        <?php echo $this->Admin->error('icp_no'); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="box box-solid box-primary">
                        <div class="box-header">
                            <h3 class="box-title">联系信息</h3>
                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-primary btn-xs" data-widget="collapse" data-toggle="tooltip" data-original-title="关闭"><i class="fa fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="box-body">
                            <div class="row">
                                <div class="col-lg-5 col-md-8 col-xs-12">
                                    <div class="form-group<?php echo $this->Admin->errorClass('commpany_name'); ?>">
                                        <label>公司名称</label>
                                        <?php echo $this->Form->text('commpany_name', ['class' => 'form-control', 'placeholder' => '公司名称']); ?>
                                        <?php echo $this->Admin->error('commpany_name'); ?>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-5 col-md-8 col-xs-12">
                                    <div class="form-group<?php echo $this->Admin->errorClass('mobile'); ?>">
                                        <label>电话</label>
                                        <?php echo $this->Form->text('mobile', ['class' => 'form-control', 'placeholder' => '电话']); ?>
                                        <?php echo $this->Admin->error('mobile'); ?>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-5 col-md-8 col-xs-12">
                                    <div class="form-group<?php echo $this->Admin->errorClass('email'); ?>">
                                        <label>邮箱</label>
                                        <?php echo $this->Form->text('email', ['class' => 'form-control', 'placeholder' => '邮箱']); ?>
                                        <?php echo $this->Admin->error('email'); ?>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-5 col-md-8 col-xs-12">
                                    <div class="form-group<?php echo $this->Admin->errorClass('fax'); ?>">
                                        <label>传真</label>
                                        <?php echo $this->Form->text('fax', ['class' => 'form-control', 'placeholder' => '传真']); ?>
                                        <?php echo $this->Admin->error('fax'); ?>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-5 col-md-8 col-xs-12">
                                    <div class="form-group<?php echo $this->Admin->errorClass('address'); ?>">
                                        <label>地址</label>
                                        <?php echo $this->Form->text('address', ['class' => 'form-control', 'placeholder' => '地址']); ?>
                                        <?php echo $this->Admin->error('address'); ?>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-8 col-md-8 col-xs-12">
                                    <div class="form-group<?php echo $this->Admin->errorClass('copyright'); ?>">
                                        <label>简短描述</label>
                                        <?php echo $this->Form->textarea('tagline', ['class' => 'form-control', 'placeholder' => '简短描述', 'rows' => 5]); ?>
                                        <?php echo $this->Admin->error('tagline'); ?>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <button class="btn btn-primary btn-flat"><i class="fa fa-save"></i> 保存</button>
                <?php echo $this->Form->end(); ?>

                </div>
            </div>
        </div>
    </div>
</div>

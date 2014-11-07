<?php
    use Cake\Core\Configure;
?>
<div class="row">
    <div class="col-md-12">
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li><?php echo $this->Html->link('站点信息', ['action' => 'index']); ?></li>
                <li class="active"><a href="javascript:;">SEO设置</a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active">

                <?php echo $this->Form->create($options); ?>

                    <div class="box box-solid box-primary">
                        <div class="box-header">
                            <h3 class="box-title">Meta信息</h3>
                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-primary btn-xs" data-widget="collapse" data-toggle="tooltip" data-original-title="关闭"><i class="fa fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="box-body">
                            <div class="row">
                                <div class="col-lg-5 col-md-8 col-xs-12">
                                    <div class="form-group<?php echo $this->Admin->errorClass('robots'); ?>">
                                        <label>Robots</label>
                                        <?php echo $this->Form->text('robots', ['class' => 'form-control', 'placeholder' => 'Robots']); ?>
                                        <?php echo $this->Admin->error('robots'); ?>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-5 col-md-8 col-xs-12">
                                    <div class="form-group<?php echo $this->Admin->errorClass('title_delimiter'); ?>">
                                        <label>标题分隔符</label>
                                        <?php echo $this->Form->text('title_delimiter', ['class' => 'form-control', 'placeholder' => '标题分隔符']); ?>
                                        <?php echo $this->Admin->error('title_delimiter'); ?>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-5 col-md-8 col-xs-12">
                                    <div class="form-group<?php echo $this->Admin->errorClass('keywords'); ?>">
                                        <label>关键字</label>
                                        <?php echo $this->Form->textarea('keywords', ['class' => 'form-control', 'placeholder' => '关键字', 'rows' => 3]); ?>
                                        <?php echo $this->Admin->error('keywords'); ?>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-5 col-md-8 col-xs-12">
                                    <div class="form-group<?php echo $this->Admin->errorClass('description'); ?>">
                                        <label>网站描述信息</label>
                                        <?php echo $this->Form->textarea('description', ['class' => 'form-control', 'placeholder' => '网站描述信息', 'rows' => 3]); ?>
                                        <?php echo $this->Admin->error('description'); ?>
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


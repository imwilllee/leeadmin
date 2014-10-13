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

                <?php echo $this->Form->create(null); ?>

                    <div class="box box-solid box-primary">
                        <div class="box-header">
                            <h3 class="box-title">全局SEO设置</h3>
                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-primary btn-xs" data-widget="collapse" data-toggle="tooltip" data-original-title="关闭"><i class="fa fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="box-body">
                            <div class="row">
                                <div class="col-lg-5 col-md-8 col-xs-12">
                                    <div class="form-group<?php echo $this->Admin->errorClass('title'); ?>">
                                        <label>网站标题</label>
                                        <?php echo $this->Form->text('title', ['class' => 'form-control', 'placeholder' => '网站标题']); ?>
                                        <?php echo $this->Admin->error('title'); ?>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-5 col-md-8 col-xs-12">
                                    <div class="form-group<?php echo $this->Admin->errorClass('keywords'); ?>">
                                        <label>网站关键字</label>
                                        <?php echo $this->Form->textarea('keywords', ['class' => 'form-control', 'placeholder' => '网站关键字', 'rows' => 3]); ?>
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

                            <div class="row">
                                <div class="col-lg-5 col-md-8 col-xs-12">
                                    <div class="form-group<?php echo $this->Admin->errorClass('title_delimiter'); ?>">
                                        <label>标题分隔符</label>
                                        <?php echo $this->Form->text('title_delimiter', ['class' => 'form-control', 'placeholder' => '标题分隔符']); ?>
                                        <?php echo $this->Admin->error('title_delimiter'); ?>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <?php echo $this->Html->link('返回一览', ['action' => 'index'], ['class' => 'btn btn-default btn-flat']); ?>
                    <button class="btn btn-primary btn-flat">确认保存</button>
                <?php echo $this->Form->end(); ?>

                </div>
            </div>
        </div>
    </div>
</div>


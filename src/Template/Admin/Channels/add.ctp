<?php
    use Cake\Core\Configure;
?>
<div class="row">
    <div class="col-md-12">
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li><?php echo $this->Html->link('栏目一览', ['action' => 'index']); ?></li>
                <li class="active"><a href="javascript:;">添加栏目</a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active">

                <?php echo $this->Form->create($channel); ?>
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
                                    <div class="form-group<?php echo $this->Admin->errorClass('parent_id'); ?>">
                                        <label>所属栏目</label>
                                        <?php echo $this->Form->select('parent_id', $parentChannelList, ['class' => 'form-control', 'placeholder' => '所属栏目']); ?>
                                        <?php echo $this->Admin->error('parent_id'); ?>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-5 col-md-8 col-xs-12">
                                    <div class="form-group<?php echo $this->Admin->errorClass('name'); ?>">
                                        <label>栏目名称</label>
                                        <?php echo $this->Form->text('name', ['class' => 'form-control', 'placeholder' => '栏目名称']); ?>
                                        <?php echo $this->Admin->error('name'); ?>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-5 col-md-8 col-xs-12">
                                    <div class="form-group<?php echo $this->Admin->errorClass('channel_code'); ?>">
                                        <label>栏目代码</label>
                                        <?php echo $this->Form->text('channel_code', ['class' => 'form-control', 'placeholder' => '栏目代码']); ?>
                                        <span class="text-light-blue">支持半角字母数字、下划线和减号，唯一不重复，长度32位。</span>
                                        <?php echo $this->Admin->error('channel_code'); ?>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-3 col-md-4 col-xs-12">
                                    <div class="form-group<?php echo $this->Admin->errorClass('type_id'); ?>">
                                        <label>栏目类型</label>
                                        <?php echo $this->Form->select('type_id', Configure::read('Channels.type'), ['class' => 'form-control']); ?>
                                        <?php echo $this->Admin->error('type_id'); ?>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12 col-xs-12">
                                    <div class="form-group<?php echo $this->Admin->errorClass('display_flg'); ?>">
                                        <label>栏目属性</label>
                                        <div class="input-group">
                                            <div class="checkbox">
                                                <?php echo $this->Form->checkbox('display_flg', ['id' => 'display_flg']); ?><label for="display_flg">显示</label>
                                            </div>
                                            <div class="checkbox">
                                                <?php echo $this->Form->checkbox('is_core', ['id' => 'is_core']); ?><label for="is_core">核心</label>
                                            </div>
                                        </div>
                                        <span class="text-light-blue">显示用于控制该栏目是否可以显示。<br>设置为核心栏目后该栏目不能删除并不能编辑栏目代码。</span>
                                        <?php echo $this->Admin->error('display_flg'); ?>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-xs-12">
                                    <div class="form-group<?php echo $this->Admin->errorClass('content'); ?>">
                                        <label>栏目内容</label>
                                        <?php echo $this->Form->textarea('content', ['class' => 'editor form-control', 'placeholder' => '栏目内容', 'rows' => 5]); ?>
                                        <?php echo $this->Admin->error('content'); ?>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="box box-solid box-primary">
                        <div class="box-header">
                            <h3 class="box-title">SEO设置</h3>
                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-primary btn-xs" data-widget="collapse" data-toggle="tooltip" data-original-title="关闭"><i class="fa fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="box-body">

                            <div class="row">
                                <div class="col-lg-8 col-md-8 col-xs-12">
                                    <div class="form-group<?php echo $this->Admin->errorClass('seo_title'); ?>">
                                        <label>栏目标题</label>
                                        <?php echo $this->Form->textarea('seo_title', ['class' => 'form-control', 'placeholder' => '备注说明', 'rows' => 5]); ?>
                                        <?php echo $this->Admin->error('seo_title'); ?>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-8 col-md-12 col-xs-12">
                                    <div class="form-group<?php echo $this->Admin->errorClass('seo_keywords'); ?>">
                                        <label>栏目关键字</label>
                                        <?php echo $this->Form->textarea('seo_keywords', ['class' => 'form-control', 'placeholder' => '栏目关键字', 'rows' => 5]); ?>
                                        <?php echo $this->Admin->error('seo_keywords'); ?>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-8 col-md-12 col-xs-12">
                                    <div class="form-group<?php echo $this->Admin->errorClass('seo_description'); ?>">
                                        <label>栏目描述</label>
                                        <?php echo $this->Form->textarea('seo_description', ['class' => 'form-control', 'placeholder' => '栏目描述', 'rows' => 5]); ?>
                                        <?php echo $this->Admin->error('seo_description'); ?>
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

<?php echo $this->element('Admin/Common/Plugin/ckeditor'); ?>

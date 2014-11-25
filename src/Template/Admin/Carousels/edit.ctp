<div class="row">
    <div class="col-md-12">
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li><?php echo $this->Html->link('KV图一览', ['action' => 'index']); ?></li>
                <?php if ($carousel->id): ?>
                <li class="active"><a href="javascript:;">KV图编辑</a></li>
                <?php else: ?>
                <li class="active"><a href="javascript:;">KV图添加</a></li>
                <?php endif; ?>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active">

                <?php echo $this->Form->create($carousel); ?>
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
                                    <div class="form-group<?php echo $this->Admin->errorClass('name'); ?>">
                                        <label>名称</label>
                                        <?php echo $this->Form->text('name', ['class' => 'form-control', 'placeholder' => '名称']); ?>
                                        <?php echo $this->Admin->error('name'); ?>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-5 col-md-8 col-xs-12">
                                    <div class="form-group<?php echo $this->Admin->errorClass('link'); ?>">
                                        <label>链接</label>
                                        <?php echo $this->Form->text('link', ['class' => 'form-control', 'placeholder' => '链接']); ?>
                                        <?php echo $this->Admin->error('link'); ?>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-5 col-md-8 col-xs-12">
                                    <div class="form-group<?php echo $this->Admin->errorClass('src'); ?>">
                                        <label>图片路径</label>
                                        <div class="input-group">
                                            <?php echo $this->Form->text('src', ['id' => 'src', 'class' => 'form-control', 'placeholder' => '图片路径']); ?>
                                            <span class="input-group-btn">
                                                <a href="javascript:;" id="preview" class="btn btn-default btn-flat"><i class="fa fa-search"></i> 预览</a>
                                                <?php
                                                    echo $this->Html->link(
                                                        '<i class="fa fa-image"></i> 选择',
                                                        ['controller' => 'Attachments', 'action' => 'index', 'image', '?' => ['type' => 'image', 'fancybox' => 'yes']],
                                                        ['class' => 'btn btn-default btn-flat', 'id' => 'choose', 'escape' => false]
                                                    );
                                                ?>
                                            </span>
                                        </div>
                                        <?php echo $this->Admin->error('src'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-2 col-md-2 col-xs-12">
                                    <div class="form-group<?php echo $this->Admin->errorClass('rank'); ?>">
                                        <label>排序</label>
                                        <?php echo $this->Form->text('rank', ['class' => 'form-control', 'placeholder' => '排序']); ?>
                                        <?php echo $this->Admin->error('rank'); ?>
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
<?php echo $this->element('Admin/Common/Plugin/fancybox'); ?>
<?php $this->append('pageScript'); ?>
<script>
    var fancybox_callback = function (href) {
        $('#src').val(href);
    }
    $(document).ready(function() {
        $('#preview').on('click', function(e){
            e.preventDefault();
            var href = $('#src').val();
            if (href != '') {
                $.fancybox({
                    href: href
                });
            }
        });
        $('#choose').fancybox({
            type: 'iframe',
            iframe:{
                scrolling : 'auto',
                preload : true
            },
            'autoScale':false
        });
    });
</script>
<?php $this->end(); ?>

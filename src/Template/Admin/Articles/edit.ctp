<?php
    use Cake\Core\Configure;
?>
<div class="row">
    <div class="col-md-12">
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li><?php echo $this->Html->link('文章一览', ['action' => 'index']); ?></li>
                <li><?php echo $this->Html->link('添加文章', ['action' => 'add', $article->channel_id]); ?></li>
                <li class="active"><a href="javascript:;">文章编辑</a></li>
            </ul>
            <div class="tab-content">
                <ol class="breadcrumb">
                <?php foreach ($breadcrumbs as $breadcrumb): ?>
                    <?php if ($breadcrumb->id == 1): ?>
                        <li><?php echo $this->Html->link('网站栏目', ['action' => 'index']); ?></li>
                    <?php else: ?>
                    <li><?php echo $this->Html->link($breadcrumb->name, ['action' => 'index', '?' => ['channel_id' => $breadcrumb->id]]); ?></li>
                    <?php endif;?>
                <?php endforeach; ?>
                <?php if ($article->channel->type_id == 2): ?>
                    <li class="active">单页编辑</li>
                <?php else: ?>
                    <li class="active">文章编辑</li>
                <?php endif;?>
                </ol>
                <div class="tab-pane active">

                <?php echo $this->Form->create($article); ?>
                <?php echo $this->Form->hidden('channel_id'); ?>
                    <div class="box box-solid box-primary">
                        <div class="box-header">
                            <h3 class="box-title">基本信息</h3>
                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-primary btn-xs" data-widget="collapse" data-toggle="tooltip" data-original-title="关闭"><i class="fa fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="box-body">
<?php if ($article->channel->type_id == 2): ?>
                            <div class="row">
                                <div class="col-lg-5 col-md-8 col-xs-12">
                                    <div class="form-group<?php echo $this->Admin->errorClass('arlicle_code'); ?>">
                                        <label>文章代码</label>
                                        <?php echo $this->Form->text('arlicle_code', ['class' => 'form-control', 'placeholder' => '文章代码']); ?>
                                        <span class="text-light-blue">用于url访问，单页类型栏目必须填写此项。</span>
                                        <?php echo $this->Admin->error('arlicle_code'); ?>
                                    </div>
                                </div>
                            </div>
<?php endif; ?>
                            <div class="row">
                                <div class="col-lg-5 col-md-8 col-xs-12">
                                    <div class="form-group<?php echo $this->Admin->errorClass('title'); ?>">
                                        <label>标题</label>
                                        <?php echo $this->Form->text('title', ['class' => 'form-control', 'placeholder' => '标题']); ?>
                                        <?php echo $this->Admin->error('title'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 col-xs-12">
                                    <div class="form-group<?php echo $this->Admin->errorClass('status'); ?>">
                                        <label>状态</label>
                                        <div class="input-group">
                                            <div class="radio">
                                                <?php echo $this->Form->radio('status', Configure::read('Articles.status'), ['default' => 0]); ?>
                                            </div>
                                        </div>
                                        <?php echo $this->Admin->error('status'); ?>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12 col-xs-12">
                                    <div class="form-group<?php echo $this->Admin->errorClass(['recommend_flg', 'hot_flg', 'new_flg']); ?>">
                                        <label>文章属性</label>
                                        <div class="input-group">
                                            <div class="checkbox">
                                                <label><?php echo $this->Form->checkbox('recommend_flg'); ?>推荐</label>
                                            </div>
                                            <div class="checkbox">
                                                <label><?php echo $this->Form->checkbox('hot_flg'); ?>热门</label>
                                            </div>
                                            <div class="checkbox">
                                                <label><?php echo $this->Form->checkbox('new_flg'); ?>最新</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-2 col-md-4 col-xs-12">
                                    <div class="form-group<?php echo $this->Admin->errorClass('rank'); ?>">
                                        <label>文章排序</label>
                                        <?php echo $this->Form->text('rank', ['class' => 'form-control', 'placeholder' => '文章排序']); ?>
                                        <span class="text-light-blue">数字越小越靠前</span>
                                        <?php echo $this->Admin->error('rank'); ?>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-5 col-md-8 col-xs-12">
                                    <div class="form-group<?php echo $this->Admin->errorClass('thumbnail'); ?>">
                                        <label>缩略图路径</label>
                                        <div class="input-group">
                                        <?php echo $this->Form->text('thumbnail', ['id' => 'thumbnail', 'class' => 'form-control', 'placeholder' => '缩略图路径']); ?>
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
                                        <?php echo $this->Admin->error('thumbnail'); ?>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-xs-12">
                                    <div class="form-group<?php echo $this->Admin->errorClass('content'); ?>">
                                        <label>内容</label>
                                        <?php echo $this->Form->textarea('content', ['class' => 'form-control editor', 'placeholder' => '内容', 'rows' => 10]); ?>
                                        <?php echo $this->Admin->error('content'); ?>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12 col-xs-12">
                                    <div class="form-group<?php echo $this->Admin->errorClass('is_delete'); ?>">
                                        <label>是否允许删除</label>
                                        <div class="input-group">
                                            <div class="radio">
                                                <?php echo $this->Form->radio('is_delete', Configure::read('Articles.delete'), ['default' => 1]); ?>
                                            </div>
                                        </div>
                                        <?php echo $this->Admin->error('is_delete'); ?>
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
                                        <label>seo标题</label>
                                        <?php echo $this->Form->textarea('seo_title', ['class' => 'form-control', 'placeholder' => 'seo标题', 'rows' => 5]); ?>
                                        <?php echo $this->Admin->error('seo_title'); ?>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-8 col-md-8 col-xs-12">
                                    <div class="form-group<?php echo $this->Admin->errorClass('seo_keywords'); ?>">
                                        <label>seo关键字</label>
                                        <?php echo $this->Form->textarea('seo_keywords', ['class' => 'form-control', 'placeholder' => 'seo关键字', 'rows' => 5]); ?>
                                        <?php echo $this->Admin->error('seo_keywords'); ?>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-8 col-md-8 col-xs-12">
                                    <div class="form-group<?php echo $this->Admin->errorClass('seo_description'); ?>">
                                        <label>seo描述</label>
                                        <?php echo $this->Form->textarea('seo_description', ['class' => 'form-control', 'placeholder' => 'seo描述', 'rows' => 5]); ?>
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

<?php echo $this->element('Admin/Common/Plugin/datetimepicker'); ?>
<?php echo $this->element('Admin/Common/Plugin/ckeditor'); ?>
<?php echo $this->element('Admin/Common/Plugin/fancybox'); ?>
<?php $this->append('pageScript'); ?>
<script>
    var fancybox_callback = function (href) {
        $('#thumbnail').val(href);
    }
    $(document).ready(function() {
        $('#preview').on('click', function(e){
            e.preventDefault();
            var href = $('#thumbnail').val();
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

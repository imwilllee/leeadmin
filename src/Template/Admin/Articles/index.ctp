<?php
    use Cake\Core\Configure;
?>

<div class="row">
    <div class="col-md-12">
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li class="active"><a href="javascript:;">文章一览</a></li>
                <li><?php echo $this->Html->link('添加文章', ['action' => 'add']); ?></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active">

                    <div class="box box-primary collapsed-box">
                    <?php echo $this->Form->create(null, ['url' => ['action' => 'index']]); ?>
                        <div class="box-header">
                            <div class="box-tools">
                                <div class="row">
                                    <div class="col-xs-10">
                                        <div class="pull-left">
                                            <div class="input-group col-lg-5 col-md-8 col-xs-12">
                                                <?php echo $this->Form->text('title', ['class' => 'form-control', 'placeholder' => '文章标题']); ?>
                                                <span class="input-group-btn">
                                                    <button class="btn btn-primary btn-flat"><i class="fa fa-search"></i> 数据检索</button>
                                                </span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-xs-2">
                                        <div class="pull-right">
                                            <button type="button" id="box-collapse" class="btn btn-primary btn-xs" data-widget="collapse" data-toggle="tooltip" data-original-title="显示"><i class="fa fa-plus"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="box-body" style="display: none;">
                            <div class="row">
                                <div class="col-lg-4 col-md-4 col-xs-12">
                                    <div class="form-group">
                                        <label>所属栏目</label>
                                        <?php echo $this->Form->select('channel_id', $channelList, ['class' => 'form-control', 'empty' => '---选择栏目---']); ?>
                                    </div>
                                </div>
                                <div class="col-lg-2 col-md-4 col-xs-12">
                                    <div class="form-group">
                                        <label>状态</label>
                                        <div class="input-group">
                                            <?php echo $this->Form->multiCheckbox('status', Configure::read('Articles.status')); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-4 col-xs-12">
                                    <div class="form-group">
                                        <label>文章属性</label>
                                        <div class="input-group">
                                            <div class="checkbox">
                                                <label><?php echo $this->Form->checkbox('recommend_flg'); ?>推荐</label>
                                            </div>
                                            <div class="checkbox">
                                                <label><?php echo $this->Form->checkbox('new_flg'); ?>最新</label>
                                            </div>
                                            <div class="checkbox">
                                                <label><?php echo $this->Form->checkbox('hot_flg'); ?>热门</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-lg-6 col-md-4 col-xs-12">
                                    <div class="form-group">
                                        <label>创建日期</label>
                                        <div class="input-group">
                                            <div class="col-lg-4 col-xs-6 no-padding">
                                                <div class="input-group">
                                                    <?php echo $this->Form->text('start_date', ['id' => 'start_date', 'class' => 'form-control', 'placeholder' => '开始日期']); ?>
                                                    <div class="input-group-addon datetimepicker" data-target-id="start_date">
                                                    <i class="fa fa-calendar"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-xs-6">
                                                <div class="input-group">
                                                    <?php echo $this->Form->text('end_date', ['id' => 'end_date', 'class' => 'form-control datetimepicker', 'placeholder' => '结束日期']); ?>
                                                    <div class="input-group-addon datetimepicker" data-target-id="end_date">
                                                    <i class="fa fa-calendar"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="box-footer" style="display: none;">
                            <button class="btn btn-primary btn-flat"><i class="fa fa-search"></i> 数据检索</button>
                        </div>
                    <?php echo $this->Form->end(); ?>
                    </div>
                    <div class="box box-primary">
                        <div class="box-header">
                            <div class="box-tools">
                                <?php echo $this->Html->link('公开', ['action' =>'attribute', 'public'], ['class' => 'btn btn-primary btn-flat batch-action']); ?>
                                <?php echo $this->Html->link('草稿', ['action' =>'attribute', 'draft'], ['class' => 'btn btn-danger btn-flat batch-action']); ?>
                                <?php echo $this->Html->link('推荐', ['action' =>'attribute', 'recommend'], ['class' => 'btn btn-info btn-flat batch-action']); ?>
                                <?php echo $this->Html->link('热门', ['action' =>'attribute', 'hot'], ['class' => 'btn btn-warning btn-flat batch-action']); ?>
                                <?php echo $this->Html->link('最新', ['action' =>'attribute', 'new'], ['class' => 'btn btn-success btn-flat batch-action']); ?>
                            </div>
                        </div>
                        <div class="box-body table-responsive no-padding">
                            <table class="table table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th style="width:25px;">
                                            <input type="checkbox" id="checkbox-selector" data-target-selector="id[]">
                                        </th>
                                        <th><?php echo $this->Paginator->sort('Articles.channel_id', '所属栏目'); ?></th>
                                        <th>标题</th>
                                        <th><?php echo $this->Paginator->sort('Articles.status', '状态'); ?></th>
                                        <th>文章属性</th>
                                        <th><?php echo $this->Paginator->sort('Articles.created', '创建日期'); ?></th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($articles as $article): ?>
                                    <tr>
                                        <td><?php echo $this->Form->checkbox('id', ['value' => $article->id, 'name' => 'id[]']); ?></td>
                                        <td><?php echo h($article->channel->name); ?></td>
                                        <td><?php echo $this->Html->link($article->title, ['action' => 'edit', $article->id]); ?></td>
                                        <td>
                                        <?php if ($article->status): ?>
                                            <?php
                                                echo $this->Html->link(
                                                    Configure::read('Articles.status.1'),
                                                    ['action' => 'attribute', 'draft', '?' => ['id' => $article->id]],
                                                    ['class' => 'label label-primary', 'confirm' => '确认更改状态？']
                                                );
                                            ?>
                                        <?php else: ?>
                                            <?php
                                                echo $this->Html->link(
                                                    Configure::read('Articles.status.0'),
                                                    ['action' => 'attribute', 'public', '?' => ['id' => $article->id]],
                                                    ['class' => 'label label-danger', 'confirm' => '确认更改状态？']
                                                );
                                            ?>
                                        <?php endif; ?>
                                        </td>
                                        <td>
                                        <?php if ($article->recommend_flg): ?>
                                            <?php
                                                echo $this->Html->link(
                                                    '荐',
                                                    ['action' => 'attribute', 'unrecommend', '?' => ['id' => $article->id]],
                                                    ['class' => 'label bg-aqua', 'confirm' => '确认取消状态？']
                                                );
                                            ?>
                                        <?php endif; ?>
                                        <?php if ($article->hot_flg): ?>
                                            <?php
                                                echo $this->Html->link(
                                                    '热',
                                                    ['action' => 'attribute', 'unhot', '?' => ['id' => $article->id]],
                                                    ['class' => 'label bg-yellow', 'confirm' => '确认取消状态？']
                                                );
                                            ?>
                                        <?php endif; ?>
                                        <?php if ($article->new_flg): ?>
                                            <?php
                                                echo $this->Html->link(
                                                    '新',
                                                    ['action' => 'attribute', 'unnew', '?' => ['id' => $article->id]],
                                                    ['class' => 'label bg-green', 'confirm' => '确认取消状态？']
                                                );
                                            ?>
                                        <?php endif; ?>
                                        </td>
                                        <td><?php echo df($article->created); ?></td>
                                        <td>
                                            <?php echo $this->Admin->iconEditLink(['action' => 'edit', $article->id]); ?>
                                            <?php if ($article->is_delete): ?>
                                                <?php echo $this->Admin->iconDeleteLink(['action' => 'delete', $article->id]); ?>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="box-footer clearfix">
            <?php echo $this->element('Admin/Common/pagination'); ?>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<?php $this->append('pageScript'); ?>
<script>
    $(function(){
        $('.batch-action').on('click', function(){
            var items = get_checked_items('id[]');
            if ($.isEmptyObject(items)) {
                alert('至少选择一个项目！');
                return false;
            }
            if (confirm('确认更改状态？')) {
                location.href = $(this).attr('href') + '?id=' +items.join('_');
            }
            return false;
        });
    });
</script>
<?php $this->end(); ?>
<?php echo $this->element('Admin/Common/Plugin/datetimepicker'); ?>

<?php
    use Cake\Core\Configure;
    use Cake\Routing\Router;
?>
<div class="row">
    <div class="col-md-12 col-sm-12">
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li class="active"><a href="javascript:;">文章一览</a></li>
                <?php if ($this->request->query('channel_id')): ?>
                <li><?php echo $this->Html->link('添加文章', ['action' => 'add', $this->request->query('channel_id')]); ?></li>
                <?php endif;?>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active">
                    <div class="box box-solid">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-3 col-sm-4">
                                    <div class="box box-solid box-primary">
                                        <div class="box-header">
                                            <h3 class="box-title">栏目结构</h3>
                                        </div>
                                        <div class="box-body" id="channels-tree">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-9 col-sm-8">
                                    <div class="box box-solid box-primary">
                                        <div class="box-header">
                                            <h3 class="box-title">文章一览</h3>
                                        </div>
                                        <div class="box-body table-responsive no-padding">
                                            <div class="row pad">
                                                <div class="col-md-6">
                                                    <div class="btn-group">
                                                        <button type="button" class="btn btn-default btn-flat dropdown-toggle" data-toggle="dropdown">
                                                            操作 <span class="caret"></span>
                                                        </button>
                                                        <ul class="dropdown-menu batch-action" role="menu">
                                                            <li><?php echo $this->Html->link('公开', ['action' =>'attribute', 'public']); ?></li>
                                                            <li><?php echo $this->Html->link('草稿', ['action' =>'attribute', 'draft']); ?></li>
                                                            <li class="divider"></li>
                                                            <li><?php echo $this->Html->link('推荐', ['action' =>'attribute', 'recommend']); ?></li>
                                                            <li><?php echo $this->Html->link('热门', ['action' =>'attribute', 'hot']); ?></li>
                                                            <li><?php echo $this->Html->link('最新', ['action' =>'attribute', 'new']); ?></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <?php echo $this->Form->create(null, ['url' => ['action' => 'index']]); ?>
                                                    <?php echo $this->Form->hidden('channel_id', ['value' => $this->request->query('channel_id')]); ?>
                                                        <div class="input-group">
                                                            <?php echo $this->Form->text('title', ['class' => 'form-control input-sm', 'placeholder' => '标题检索']); ?>
                                                            <div class="input-group-btn">
                                                                <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-search"></i></button>
                                                            </div>
                                                        </div>
                                                    <?php echo $this->Form->end(); ?>
                                                </div>
                                            </div>
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
                                                    <?php $urlParams = ['id' => $article->id, 'channel_id' => $this->request->query('channel_id')]; ?>
                                                    <tr>
                                                        <td><?php echo $this->Form->checkbox('id', ['value' => $article->id, 'name' => 'id[]']); ?></td>
                                                        <td><?php echo h($article->channel->name); ?></td>
                                                        <td><?php echo $this->Html->link($article->title, ['action' => 'edit', $article->id]); ?></td>
                                                        <td>
                                                        <?php if ($article->status): ?>
                                                            <?php
                                                                echo $this->Html->link(
                                                                    Configure::read('Articles.status.1'),
                                                                    ['action' => 'attribute', 'draft', '?' => $urlParams],
                                                                    ['class' => 'label label-primary', 'confirm' => '确认更改状态？']
                                                                );
                                                            ?>
                                                        <?php else: ?>
                                                            <?php
                                                                echo $this->Html->link(
                                                                    Configure::read('Articles.status.0'),
                                                                    ['action' => 'attribute', 'public', '?' => $urlParams],
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
                                                                    ['action' => 'attribute', 'unrecommend', '?' => $urlParams],
                                                                    ['class' => 'label bg-aqua', 'confirm' => '确认取消状态？']
                                                                );
                                                            ?>
                                                        <?php endif; ?>
                                                        <?php if ($article->hot_flg): ?>
                                                            <?php
                                                                echo $this->Html->link(
                                                                    '热',
                                                                    ['action' => 'attribute', 'unhot', '?' => $urlParams],
                                                                    ['class' => 'label bg-yellow', 'confirm' => '确认取消状态？']
                                                                );
                                                            ?>
                                                        <?php endif; ?>
                                                        <?php if ($article->new_flg): ?>
                                                            <?php
                                                                echo $this->Html->link(
                                                                    '新',
                                                                    ['action' => 'attribute', 'unnew', '?' => $urlParams],
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
                        <div class="box-footer clearfix">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->element('Admin/Common/Plugin/dtree'); ?>
<?php $this->append('pageScript'); ?>
<script>
    var channelsTree = function () {
        d = new dTree('d');
        d.add(1, -1, '网站栏目', '<?php echo Router::url(['action' => 'index']); ?>');
<?php foreach ($channelsTree as $tree): ?>
    <?php if ($tree->id == $this->request->query('channel_id')): ?>
    d.add(<?php echo $tree->id; ?>, <?php echo $tree->parent_id; ?>, '<span class="label label-primary"><?php echo h($tree->name); ?></span>', '<?php echo Router::url(['action' => 'index', '?' => ['channel_id' => $tree->id]]); ?>');
    <?php else: ?>
        d.add(<?php echo $tree->id; ?>, <?php echo $tree->parent_id; ?>, '<?php echo h($tree->name); ?>', '<?php echo Router::url(['action' => 'index', '?' => ['channel_id' => $tree->id]]); ?>');
    <?php endif; ?>
<?php endforeach; ?>
        return d.toString();
    }
    $(function(){
        $('#channels-tree').html(channelsTree());
        $('.batch-action a').on('click', function(){
            var items = get_checked_items('id[]');
            if ($.isEmptyObject(items)) {
                alert('至少选择一个项目！');
                return false;
            }
            if (confirm('确认更改状态？')) {
                location.href = $(this).attr('href') + '?id=' +items.join('_') + '&channel_id=<?php echo $this->request->query('channel_id'); ?>';
            }
            return false;
        });
    });
</script>
<?php $this->end(); ?>

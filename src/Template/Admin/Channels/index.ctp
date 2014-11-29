<?php
    use Cake\Core\Configure;
    use Cake\Routing\Router;
?>
<div class="row">
    <div class="col-md-12 col-sm-12">
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li class="active"><a href="javascript:;">栏目一览</a></li>
                <li><?php echo $this->Html->link('添加栏目', ['action' => 'add']); ?></li>
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
                                            <h3 class="box-title">子栏目一览</h3>
                                            <div class="box-tools pull-right">
                                            </div>
                                        </div>
                                        <div class="box-body table-responsive no-padding">
                                            <table class="table table-hover table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>ID</th>
                                                        <th>栏目名称</th>
                                                        <th>栏目代码</th>
                                                        <th>类型</th>
                                                        <th>显示</th>
                                                        <th>核心</th>
                                                        <th>排序</th>
                                                        <th></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach ($childrens as $children): ?>
                                                    <tr>
                                                        <td><?php echo $children->id; ?></td>
                                                        <td>
                                                        <?php echo $this->Html->link($children->name, ['controller' => 'Articles', 'action' => 'index', '?' => ['channel_id' => $children->id]]); ?>
                                                        </td>
                                                        <td><?php echo h($children->channel_code); ?></td>
                                                        <td>
                                                            <?php if ($children->type_id): ?>
                                                                <?php echo Configure::read('Channels.type.' . $children->type_id); ?>
                                                            <?php endif; ?>
                                                        </td>
                                                        <td>
                                                            <?php if ($children->display_flg): ?>
                                                                <span class="label label-primary"><?php echo Configure::read('Common.boolen.1'); ?></span>
                                                            <?php else: ?>
                                                                <span class="label label-danger"><?php echo Configure::read('Common.boolen.0'); ?></span>
                                                            <?php endif; ?>
                                                        </td>
                                                        <td>
                                                            <?php if ($children->is_core): ?>
                                                                <span class="label label-primary"><?php echo Configure::read('Common.boolen.1'); ?></span>
                                                            <?php else: ?>
                                                                <span class="label label-danger"><?php echo Configure::read('Common.boolen.0'); ?></span>
                                                            <?php endif; ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $this->Admin->iconLink('fa fa-1 fa-arrow-up', ['action' => 'rank', $children->id, '?' => ['parent_id' => $children->parent_id]], ['data-original-title' => '上移']); ?>
                                                            <?php echo $this->Admin->iconLink('fa fa-1 fa-arrow-down', ['action' => 'rank', $children->id, 'down', '?' => ['parent_id' => $children->parent_id]], ['data-original-title' => '下移']); ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $this->Admin->iconLink('fa fa-1 fa fa-file-text-o', ['controller' => 'Articles', 'action' => 'add', $children->id], ['data-original-title' => '添加文章']); ?>
                                                            <?php echo $this->Admin->iconLink('fa fa-1 fa-plus-square', ['action' => 'add', $children->id], ['data-original-title' => '添加子栏目']); ?>
                                                            <?php echo $this->Admin->iconEditLink(['action' => 'edit', $children->id]); ?>
                                                            <?php
                                                                if (!$children->is_core):
                                                                    echo $this->Admin->iconDeleteLink(['action' => 'delete', $children->id]);
                                                                endif;
                                                            ?>
                                                        </td>
                                                    </tr>
                                                    <?php endforeach; ?>
                                                </tbody>
                                            </table>
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
    <?php if ($tree->id == $this->request->query('parent_id')): ?>
    d.add(<?php echo $tree->id; ?>, <?php echo $tree->parent_id; ?>, '<span class="label label-primary"><?php echo h($tree->name); ?></span>', '<?php echo Router::url(['action' => 'index', '?' => ['parent_id' => $tree->id]]); ?>');
    <?php else: ?>
        d.add(<?php echo $tree->id; ?>, <?php echo $tree->parent_id; ?>, '<?php echo h($tree->name); ?>', '<?php echo Router::url(['action' => 'index', '?' => ['parent_id' => $tree->id]]); ?>');
    <?php endif; ?>
<?php endforeach; ?>
        return d.toString();
    }
    $(function(){
        $('#channels-tree').html(channelsTree());
    });
</script>
<?php $this->end(); ?>

<?php
    use Cake\Core\Configure;
?>
<?php $this->append('pageStyle'); ?>
<style type="text/css">
    .form-group span{
        margin-bottom: 5px;
    }
</style>
<?php $this->end(); ?>
<div class="row">
    <div class="col-md-12">
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#basic-info" data-toggle="tab">基本信息</a></li>
                <li><a href="#access" data-toggle="tab">访问权限</a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="basic-info">
                    <div class="box box-solid box-primary">
                        <div class="box-header">
                            <h3 class="box-title">用户组信息</h3>
                        </div>
                        <div class="box-body">
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="form-group">
                                        <label>用户组名称</label>
                                        <p><?php echo h($group->name); ?></p>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="form-group">
                                        <label>状态</label>
                                        <p>
                                            <?php
                                                if ($group->status) {
                                                    echo Configure::read('Common.status.1');
                                                } else {
                                                    echo Configure::read('Common.status.0');
                                                }
                                            ?>
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="form-group">
                                        <label>备注说明</label>
                                        <p><?php echo nl2br(h($group->explain)); ?></p>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="tab-pane" id="access">
                    <div class="box box-solid box-primary">
                        <div class="box-header">
                            <h3 class="box-title">核心功能</h3>
                        </div>
                        <div class="box-body">
                            <div class="row">
                                <?php foreach ($menuNodes as $menu): ?>
                                <div class="col-lg-4 col-md-6 col-xs-12">
                                    <div class="box box-primary">
                                        <div class="box-header">
                                            <h3 class="box-title"><?php echo h($menu->name); ?></h3>
                                        </div>
                                        <div class="box-body">
                                            <div class="form-group">
                                                <?php foreach ($menu->menu_nodes as $node): ?>
                                                    <?php if (in_array($node->id, $access)): ?>
                                                    <span class="btn btn-success btn-sm"><i class="fa fa-check"></i> <?php echo h($node->name); ?></span>
                                                    <?php else: ?>
                                                    <span class="btn btn-danger btn-sm"><i class="fa fa-times"></i> <?php echo h($node->name); ?></span>
                                                    <?php endif; ?>
                                                <?php endforeach; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php endforeach; ?>
                            </div>

                        </div>
                    </div>

                    <div class="box box-solid box-primary">
                        <div class="box-header">
                            <h3 class="box-title">插件功能</h3>
                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-primary btn-xs" data-widget="collapse" data-toggle="tooltip" data-original-title="关闭"><i class="fa fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="box-body">
                            <div class="row">
                                <?php foreach ($pulginMenuNodes as $menu): ?>
                                <div class="col-lg-4 col-md-6 col-xs-12">
                                    <div class="box box-primary">
                                        <div class="box-header">
                                            <h3 class="box-title"><?php echo h($menu->name); ?></h3>
                                        </div>
                                        <div class="box-body">
                                            <div class="form-group">
                                                <?php foreach ($menu->menu_nodes as $node): ?>
                                                    <?php if (in_array($node->id, $access)): ?>
                                                    <span class="btn btn-success btn-sm"><i class="fa fa-check"></i> <?php echo h($node->name); ?></span>
                                                    <?php else: ?>
                                                    <span class="btn btn-danger btn-sm"><i class="fa fa-times"></i> <?php echo h($node->name); ?></span>
                                                    <?php endif; ?>
                                                <?php endforeach; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>

                <?php echo $this->Html->link('返回一览', ['action' => 'index'], ['class' => 'btn btn-default btn-flat']); ?>
                <?php echo $this->Html->link('编辑信息', ['action' => 'edit', $group->id], ['class' => 'btn btn-primary btn-flat']); ?>
            </div>
        </div>
    </div>
</div>

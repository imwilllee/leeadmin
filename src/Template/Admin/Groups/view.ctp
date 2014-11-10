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
                <li><?php echo $this->Html->link('用户组一览', ['action' => 'index']); ?></li>
                <li><?php echo $this->Html->link('创建用户组', ['action' => 'add']); ?></li>
                <li class="active"><a href="javascript:;">用户组详细</a></li>
                <li><?php echo $this->Html->link('用户组编辑', ['action' => 'edit', $group->id]); ?></li>
                <li><?php echo $this->Html->link('访问权限', ['action' => 'access', $group->id]); ?></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active">
                    <div class="box box-solid box-primary">
                        <div class="box-header">
                            <h3 class="box-title">基本信息</h3>
                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-primary btn-xs" data-widget="collapse" data-toggle="tooltip" data-original-title="关闭"><i class="fa fa-minus"></i></button>
                            </div>
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

                    <div class="box box-solid box-primary">
                        <div class="box-header">
                            <h3 class="box-title">核心功能</h3>
                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-primary btn-xs" data-widget="collapse" data-toggle="tooltip" data-original-title="关闭"><i class="fa fa-minus"></i></button>
                            </div>
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

<?php if (!empty($pulginMenuNodes)): ?>
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
<?php endif; ?>

                </div>
                <?php echo $this->element('Admin/Common/view_btn', ['edit_url' => ['action' => 'edit', $group->id]]); ?>
            </div>
        </div>
    </div>
</div>

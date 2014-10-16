<?php
    use Cake\Core\Configure;
?>
<div class="row">
    <div class="col-md-12">
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li class="active"><a href="javascript:;">用户组一览</a></li>
                <li><?php echo $this->Html->link('创建用户组', ['action' => 'add']); ?></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active">
                    <div class="box box-primary">
                    <?php echo $this->Form->create(null, ['url' => ['action' => 'index']]); ?>
                        <div class="box-body">
                            <div class="row">
                                <div class="col-lg-4 col-md-6 col-xs-12">
                                    <div class="form-group">
                                        <label>用户组名称</label>
                                        <?php echo $this->Form->text('name', ['class' => 'form-control', 'placeholder' => '用户组名称']); ?>
                                    </div>
                                </div>
                                <div class="col-lg-8 col-md-6 col-xs-12">
                                    <div class="form-group">
                                        <label>状态</label>
                                        <div class="input-group">
                                            <?php echo $this->Form->multiCheckbox('status', Configure::read('Common.status')); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="box-footer">
                            <button class="btn btn-primary btn-flat">数据检索</button>
                        </div>
                    <?php echo $this->Form->end(); ?>
                    </div>
                    <div class="box box-primary">
                        <div class="box-body table-responsive no-padding">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th style="width:40px;"><?php echo $this->Paginator->sort('id', '#'); ?></th>
                                        <th>用户组名称</th>
                                        <th><?php echo $this->Paginator->sort('status', '状态'); ?></th>
                                        <th>备注说明</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($groups as $group): ?>
                                    <tr>
                                        <td><?php echo $group->id; ?></td>
                                        <td>
                                        <?php
                                            echo $group->id != INIT_GROUP_ID ? $this->Html->link($group->name, ['action' => 'view', $group->id]) : $group->name;
                                        ?>
                                        </td>
                                        <td>
                                        <?php if ($group->id != INIT_GROUP_ID): ?>
                                            <?php if ($group->status): ?>
                                                <?php
                                                    echo $this->Html->link(
                                                        Configure::read('Common.status.1'),
                                                        ['action' => 'active', 'disable', $group->id],
                                                        ['class' => 'label label-primary', 'confirm' => '确认更改状态？']
                                                    );
                                                ?>
                                            <?php else: ?>
                                                <?php
                                                    echo $this->Html->link(
                                                        Configure::read('Common.status.0'),
                                                        ['action' => 'active', 'enable', $group->id],
                                                        ['class' => 'label label-danger', 'confirm' => '确认更改状态？']
                                                    );
                                                ?>
                                            <?php endif; ?>
                                        <?php else:?>
                                            <?php if ($group->status): ?>
                                                <span class="label label-primary"><?php echo Configure::read('Common.status.1'); ?></span>
                                            <?php else: ?>
                                                <span class="label label-danger"><?php echo Configure::read('Common.status.0'); ?></span>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                        </td>
                                        <td><?php echo nl2br(h($group->explain)); ?></td>
                                        <td>
                                        <?php if ($group->id != INIT_GROUP_ID): ?>
                                            <?php echo $this->Admin->iconEditLink(['action' => 'edit', $group->id]); ?>
                                            <?php echo $this->Admin->iconLink('fa fa-1 fa-lock', ['action' => 'access', $group->id], ['data-original-title' => '权限']); ?>
                                            <?php echo $this->Admin->iconDeleteLink(['action' => 'delete', $group->id]); ?>
                                        <?php endif; ?>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="box-footer clearfix">
            <?php echo $this->element('Common/pagination'); ?>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

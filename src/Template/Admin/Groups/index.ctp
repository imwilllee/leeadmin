<?php
    use Cake\Core\Configure;
?>
<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
        <?php echo $this->Form->create(null, ['url' => ['action' => 'index']]); ?>
            <div class="box-body">
                <div class="row">
                    <div class="col-md-4 col-xs-12">
                        <div class="form-group">
                            <label>用户组名称</label>
                            <?php echo $this->Form->text('name', ['class' => 'form-control', 'placeholder' => '用户组名称']); ?>
                        </div>
                    </div>
                    <div class="col-md-4 col-xs-12">
                        <div class="form-group">
                            <label>状态</label>
                            <div class="input-group">
                                <?php echo $this->Form->multiCheckbox('status', Configure::read('Common.status'), ['class' => false]); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="box-footer">
                <button type="button" id="form-reset" class="btn btn-default btn-flat">条件重置</button>
                <button class="btn btn-primary btn-flat">数据检索</button>
            </div>
        <?php echo $this->Form->end(); ?>
        </div>
        <div class="box box-primary">
            <div class="box-header">
                <div class="box-tools">
                    <div class="btn-group">
                        <button type="button" class="btn btn-default btn-flat">批量操作</button>
                        <button type="button" class="btn btn-default btn-flat dropdown-toggle" data-toggle="dropdown">
                            <span class="caret"></span>
                            <span class="sr-only">批量操作</span>
                        </button>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="javascript:;">禁用</a></li>
                            <li><a href="javascript:;">启用</a></li>
                        </ul>
                    </div>
                    <?php echo $this->Html->link('创建用户组', ['action' => 'add'], ['class' => 'btn btn-primary btn-flat']); ?>
                </div>
            </div>
            <div class="box-body table-responsive no-padding">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th style="width:25px;"><input type="checkbox" id="checkbox-selector" data-target-selector="id[]"></th>
                            <th>用户组名称</th>
                            <th><?php echo $this->Paginator->sort('status', '状态'); ?></th>
                            <th>备注说明</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($groups as $group): ?>
                        <tr>
                            <td><?php echo $this->Form->checkbox('id', ['value' => $group->id, 'name' => 'id[]']); ?></td>
                            <td><?php echo h($group->name); ?></td>
                            <td>
                            <?php if ($group->status): ?>
                                <span class="label label-primary"><?php echo Configure::read('Common.status.1'); ?></span>
                            <?php else: ?>
                                <span class="label label-danger"><?php echo Configure::read('Common.status.0'); ?></span>
                            <?php endif; ?>
                            </td>
                            <td><?php echo h($group->explain); ?></td>
                            <td class="actions">
                                <?php echo $this->Admin->iconViewLink(['action' => 'view', $group->id]); ?>
                                <?php echo $this->Admin->iconEditLink(['action' => 'edit', $group->id]); ?>
                                <?php echo $this->Admin->iconDeleteLink(['action' => 'delete', $group->id]); ?>
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

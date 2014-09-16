<?php
    use Cake\Core\Configure;
?>
<div class="row">
    <div class="col-md-12">
        <div class="box box-primary collapsed-box">
        <?php echo $this->Form->create(null); ?>
            <div class="box-header">
                <div class="box-tools">
                    <div class="row">
                        <div class="col-xs-10">
                            <div class="pull-left">
                                <div class="input-group col-md-4">
                                    <input type="text" class="form-control" placeholder="关键字检索">
                                    <span class="input-group-btn">
                                        <button class="btn btn-primary btn-flat">检索</button>
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
                    <div class="col-md-4 col-xs-12">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email address</label>
                            <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
                        </div>
                    </div>
                    <div class="col-md-4 col-xs-12">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email address</label>
                            <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
                        </div>
                    </div>
                    <div class="col-md-4 col-xs-12">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email address</label>
                            <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 col-xs-12">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email address</label>
                            <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
                        </div>
                    </div>
                    <div class="col-md-4 col-xs-12">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email address</label>
                            <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
                        </div>
                    </div>
                    <div class="col-md-4 col-xs-12">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email address</label>
                            <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
                        </div>
                    </div>
                </div>
            </div>
            <div class="box-footer" style="display: none;">
                <button type="button" id="form-reset" class="btn btn-default btn-flat">条件重置</button>
                <button class="btn btn-primary btn-flat">检索</button>
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
                            <li><a>禁用</a></li>
                            <li><a>启用</a></li>
                        </ul>
                    </div>
                    <a class="btn btn-primary btn-flat">创建用户组</a>
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
                        <?php foreach ($users as $user): ?>
                        <tr>
                            <td><?php echo $this->Form->checkbox('id', ['value' => $user->id, 'name' => 'id[]']); ?></td>
                            <td><?php echo h($user->alias); ?></td>
                            <td>
                            <?php if ($user->status): ?>
                                <span class="label label-primary"><?php echo Configure::read('Common.status.1'); ?></span>
                            <?php else: ?>
                                <span class="label label-danger"><?php echo Configure::read('Common.status.0'); ?></span>
                            <?php endif; ?>
                            </td>
                            <td><?php echo h($user->explain); ?></td>
                            <td class="actions">
                                <?php echo $this->Admin->iconViewLink(['action' => 'view', $user->id]); ?>
                                <?php echo $this->Admin->iconEditLink(['action' => 'edit', $user->id]); ?>
                                <?php echo $this->Admin->iconDeleteLink(['action' => 'delete', $user->id]); ?>
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

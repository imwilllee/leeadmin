<?php
    use Cake\Core\Configure;
    use Cake\Routing\Router;
?>
<div class="row">
    <div class="col-md-12">
        <div class="box box-primary collapsed-box">
        <?php echo $this->Form->create(null, ['url' => ['action' => 'index']]); ?>
            <div class="box-header">
                <div class="box-tools">
                    <div class="row">
                        <div class="col-xs-10">
                            <div class="pull-left">
                                <div class="input-group col-lg-5 col-md-8 col-xs-12">
                                    <?php echo $this->Form->text('q', ['class' => 'form-control', 'placeholder' => '昵称或邮箱']); ?>
                                    <span class="input-group-btn">
                                        <button class="btn btn-primary btn-flat">数据检索</button>
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
                    <div class="col-lg-4 col-md-6 col-xs-12">
                        <div class="form-group">
                            <label>邮箱</label>
                            <?php echo $this->Form->text('email', ['class' => 'form-control', 'placeholder' => '邮箱']); ?>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-xs-12">
                        <div class="form-group">
                            <label>用户组</label>
                            <?php echo $this->Form->select('group_id', $groupList, ['class' => 'form-control', 'empty' => '选择用户组']); ?>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-xs-12">
                        <div class="form-group">
                            <label>状态</label>
                            <div class="input-group">
                                <?php echo $this->Form->multiCheckbox('status', Configure::read('Common.status')); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="box-footer" style="display: none;">
                <button class="btn btn-primary btn-flat">数据检索</button>
            </div>
        <?php echo $this->Form->end(); ?>
        </div>
        <div class="box box-primary">
            <div class="box-header">
                <div class="box-tools">
                    <div class="btn-group" id="action-menus">
                        <button type="button" class="btn btn-default btn-flat">操作</button>
                        <button type="button" class="btn btn-default btn-flat dropdown-toggle" data-toggle="dropdown">
                            <span class="caret"></span>
                            <span class="sr-only">操作</span>
                        </button>
                        <ul class="dropdown-menu">
                            <li><?php echo $this->Html->link('禁用', ['action' =>'active', 'disable'], ['class' => 'batch-action']); ?></li>
                            <li><?php echo $this->Html->link('启用', ['action' =>'active', 'enable'], ['class' => 'batch-action']); ?></li>
                        </ul>
                    </div>
                    <?php echo $this->Html->link('创建管理员', ['action' => 'add'], ['class' => 'btn btn-primary btn-flat']); ?>
                </div>
            </div>
            <div class="box-body table-responsive no-padding">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th style="width:25px;">
                                <input type="checkbox" id="checkbox-selector" data-target-selector="id[]">
                            </th>
                            <th>昵称（邮箱）</th>
                            <th><?php echo $this->Paginator->sort('Users.status', '状态'); ?></th>
                            <th><?php echo $this->Paginator->sort('Users.group_id', '用户组'); ?></th>
                            <th><?php echo $this->Paginator->sort('Users.created', '创建日期'); ?></th>
                            <th><?php echo $this->Paginator->sort('Users.last_logined', '最后登录日期'); ?></th>
                            <th>最后登录IP</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($users as $user): ?>
                        <tr>
                            <td><?php echo $this->Form->checkbox('id', ['value' => $user->id, 'name' => 'id[]']); ?></td>
                            <td>
                            <?php echo $this->Html->link($user->alias, ['action' => 'view', $user->id]); ?>
                            <br>
                            <?php echo $this->Html->link($user->email, ['action' => 'view', $user->id]); ?>
                            </td>
                            <td>
                            <?php if ($user->status): ?>
                                <?php
                                    echo $this->Html->link(
                                        Configure::read('Common.status.1'),
                                        ['action' => 'active', 'disable', '?' => ['id' => $user->id]],
                                        ['class' => 'label label-primary', 'confirm' => '确认更改状态？']
                                    );
                                ?>
                            <?php else: ?>
                                <?php
                                    echo $this->Html->link(
                                        Configure::read('Common.status.0'),
                                        ['action' => 'active', 'enable', '?' => ['id' => $user->id]],
                                        ['class' => 'label label-danger', 'confirm' => '确认更改状态？']
                                    );
                                ?>
                            <?php endif; ?>
                            </td>
                            <td>
                            <?php
                                echo $user->group_id == INIT_GROUP_ID ? h($user->group->name) : $this->Html->link($user->group->name, ['controller' => 'Groups', 'action' => 'view', $user->group_id]);
                            ?>
                            </td>
                            <td><?php echo $this->Admin->showDateTime($user->created); ?></td>
                            <td><?php echo $this->Admin->showDateTime($user->last_logined); ?></td>
                            <td><?php echo h($user->last_login_ip); ?></td>
                            <td>
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
<?php $this->append('pageScript'); ?>
<script>
    $(function(){
        $('.batch-action').on('click', function(){
            $('#action-menus').removeClass('open');
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
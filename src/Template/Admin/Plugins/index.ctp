<?php
    use Cake\Core\Configure;
?>
<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
        <?php echo $this->Form->create(null, ['url' => ['action' => 'index']]); ?>
            <div class="box-body">
                <div class="row">
                    <div class="col-lg-4 col-md-6 col-xs-12">
                        <div class="form-group">
                            <label>插件名称</label>
                            <?php echo $this->Form->text('name', ['class' => 'form-control', 'placeholder' => '插件名称']); ?>
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
            <div class="box-header">
                <div class="box-tools">
                    <?php echo $this->Html->link('插件安装', ['action' => 'install'], ['class' => 'btn btn-primary btn-flat']); ?>
                </div>
            </div>
            <div class="box-body table-responsive no-padding">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th style="width:40px;"><?php echo $this->Paginator->sort('id', '#'); ?></th>
                            <th>插件代码</th>
                            <th>插件名称</th>
                            <th><?php echo $this->Paginator->sort('status', '状态'); ?></th>
                            <th>版本号</th>
                            <th>开发者</th>
                            <th>安装日期</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($plugins as $plugin): ?>
                        <tr>
                            <td><?php echo $plugin->id; ?></td>
                            <td><?php echo h($plugin->plugin_code); ?></td>
                            <td><?php echo h($plugin->name); ?></td>
                            <td>
                            <?php if ($plugin->status): ?>
                                <?php
                                    echo $this->Html->link(
                                        Configure::read('Common.status.1'),
                                        ['action' => 'active', 'disable', $plugin->id],
                                        ['class' => 'label label-primary']
                                    );
                                ?>
                            <?php else: ?>
                                <?php
                                    echo $this->Html->link(
                                        Configure::read('Common.status.0'),
                                        ['action' => 'active', 'enable', $plugin->id],
                                        ['class' => 'label label-danger']
                                    );
                                ?>
                            <?php endif; ?>
                            </td>
                            <td><?php echo h($plugin->version); ?></td>
                            <td><?php echo h($plugin->developer); ?></td>
                            <td>
                                <?php echo $this->Admin->iconEditLink(['action' => 'edit', $plugin->id]); ?>
                                <?php echo $this->Admin->iconDeleteLink(['action' => 'delete', $plugin->id]); ?>
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
        $('.change-status').on('click', function(){
            var checked = get_checked_items('id[]');
            if (!$.isEmptyObject(checked)) {
                var href = $(this).attr('href') + '/' + checked.join('-');
                $(this).attr('href', href);
                return true;
            } else {
                alert('请至少选择一个项目！');
                return false;
            }
        });
    });
</script>
<?php $this->end(); ?>
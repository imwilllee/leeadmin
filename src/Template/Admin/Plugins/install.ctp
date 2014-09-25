<?php
    use Cake\Core\Configure;
?>
<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">未安装插件一览</h3>
            </div>
            <div class="box-body table-responsive no-padding">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>插件代码</th>
                            <th>插件名称</th>
                            <th>版本号</th>
                            <th>开发者</th>
                            <th>依赖插件代码</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($plugins as $pluginCode => $plugin): ?>
                        <tr>
                            <td><?php echo h($pluginCode); ?></td>
                            <td><?php echo h($plugin['basic']['name']); ?></td>
                            <td><?php echo h($plugin['basic']['version']); ?></td>
                            <td><?php echo h($plugin['basic']['developer']); ?></td>
                            <td>
                                <?php if (!empty($plugin['basic']['require'])): ?>
                                    <?php foreach ($plugin['basic']['require'] as $code): ?>
                                    <span class="badge bg-red"><?php echo $code; ?></span><br>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php echo $this->Html->link('安装', ['action' => 'install', $pluginCode], ['class' => 'btn btn-primary btn-flat']); ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <div class="box-footer clearfix">
                <?php echo $this->Html->link('返回一览', ['action' => 'index'], ['class' => 'btn btn-default btn-flat']); ?>
            </div>
        </div>

    </div>
</div>

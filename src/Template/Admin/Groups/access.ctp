<?php
    use Cake\Core\Configure;
?>
<div class="row">
    <div class="col-md-12">
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li><?php echo $this->Html->link('用户组一览', ['action' => 'index']); ?></li>
                <li><?php echo $this->Html->link('创建用户组', ['action' => 'add']); ?></li>
                <li><?php echo $this->Html->link('用户组详细', ['action' => 'view', $group->id]); ?></li>
                <li><?php echo $this->Html->link('用户组编辑', ['action' => 'edit', $group->id]); ?></li>
                <li class="active"><a href="javascript:;">访问权限</a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active">

                <?php echo $this->Form->create($group); ?>
                <?php $this->Form->unlockField('menu_node_id'); ?>
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
                                            <div class="box-tools pull-right">
                                                <input type="checkbox" class="checked-all" value="<?php echo $menu->id; ?>">
                                            </div>
                                        </div>
                                        <div class="box-body">
                                            <div class="form-group">
                                                <div class="input-group">
                                                <?php foreach ($menu->menu_nodes as $node): ?>
                                                    <div class="checkbox">
                                                        <?php
                                                            $attrId = sprintf('menu-node-%s', $node->id);
                                                            echo $this->Form->checkbox(
                                                                    'menu_node_id',
                                                                    [
                                                                        'name' => 'menu_node_id[]',
                                                                        'id' => $attrId,
                                                                        'checked' => in_array($node->id, $access),
                                                                        'value' => $node->id,
                                                                        'hiddenField' => false,
                                                                        'class' => 'belongs-' . $menu->id
                                                                    ]
                                                            );
                                                        ?>
                                                        <label for="<?php echo $attrId; ?>"><?php echo h($node->name); ?></label>
                                                    </div>
                                                <?php endforeach; ?>
                                                </div>
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
                                            <div class="box-tools pull-right">
                                                <input type="checkbox" class="checked-all" value="<?php echo $menu->id; ?>">
                                            </div>
                                        </div>
                                        <div class="box-body">
                                            <div class="form-group">
                                                <div class="input-group">
                                                <?php foreach ($menu->menu_nodes as $node): ?>
                                                    <div class="checkbox">
                                                        <?php
                                                            $attrId = sprintf('menu-node-%s', $node->id);
                                                            echo $this->Form->checkbox(
                                                                    'menu_node_id',
                                                                    [
                                                                        'name' => 'menu_node_id[]',
                                                                        'id' => $attrId,
                                                                        'checked' => in_array($node->id, $access),
                                                                        'value' => $node->id,
                                                                        'hiddenField' => false,
                                                                        'class' => 'belongs-' . $menu->id
                                                                    ]
                                                            );
                                                        ?>
                                                        <label for="<?php echo $attrId; ?>"><?php echo h($node->name); ?></label>
                                                    </div>
                                                <?php endforeach; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>

                    <?php echo $this->Html->link('返回一览', ['action' => 'index'], ['class' => 'btn btn-default btn-flat']); ?>
                    <button class="btn btn-primary btn-flat">确认保存</button>

                <?php echo $this->Form->end(); ?>

                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->append('pageScript'); ?>
<script>
    $(function(){
        $('.checked-all').on("ifChanged", function(e){
            var checkbox = $('.belongs-' + $(this).val());
            if ($(this).prop("checked")) {
                checkbox.iCheck("check");
            } else {
                checkbox.iCheck("uncheck");
            }
        });
    });
</script>
<?php $this->end(); ?>

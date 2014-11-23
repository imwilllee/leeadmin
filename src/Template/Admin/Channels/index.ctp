<?php
    use Cake\Core\Configure;
?>
<div class="row">
    <div class="col-md-12">
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li class="active"><a href="javascript:;">栏目一览</a></li>
                <li><?php echo $this->Html->link('添加栏目', ['action' => 'add']); ?></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active">
                    <div class="box box-primary">
                        <div class="box-body table-responsive no-padding">
                            <table class="table table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th style="width:45px;">#</th>
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
                                    <?php foreach ($channels as $channel): ?>
                                    <tr>
                                        <td>
                                        <?php if ($channel->level == 0): ?>
                                        <span class="label label-info">Top</span>
                                        <?php endif; ?>
                                        </td>
                                        <td class="channel-level" data-channel-level="<?php echo $channel->level; ?>">
                                        <?php echo $this->Html->link($channel->name, ['action' => 'edit', $channel->id]); ?>
                                        </td>
                                        <td><?php echo h($channel->channel_code); ?></td>
                                        <td>
                                            <?php if ($channel->type_id): ?>
                                                <?php echo Configure::read('Channels.type.' . $channel->type_id); ?>
                                            <?php endif; ?>

                                        </td>
                                        <td>
                                            <?php if ($channel->display_flg): ?>
                                                <span class="label label-primary"><?php echo Configure::read('Common.boolen.1'); ?></span>
                                            <?php else: ?>
                                                <span class="label label-danger"><?php echo Configure::read('Common.boolen.0'); ?></span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <?php if ($channel->is_core): ?>
                                                <span class="label label-primary"><?php echo Configure::read('Common.boolen.1'); ?></span>
                                            <?php else: ?>
                                                <span class="label label-danger"><?php echo Configure::read('Common.boolen.0'); ?></span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <?php echo $this->Admin->iconLink('fa fa-1 fa-arrow-up', ['action' => 'rank', $channel->id], ['data-original-title' => '上移']); ?>
                                            <?php echo $this->Admin->iconLink('fa fa-1 fa-arrow-down', ['action' => 'rank', $channel->id, 'down'], ['data-original-title' => '下移']); ?>
                                        </td>
                                        <td>
                                            <?php echo $this->Admin->iconLink('fa fa-1 fa fa-file-text-o', ['controller' => 'Articles', 'action' => 'add', $channel->id], ['data-original-title' => '添加文章']); ?>
                                            <?php echo $this->Admin->iconLink('fa fa-1 fa-plus-square', ['action' => 'add', $channel->id], ['data-original-title' => '添加子栏目']); ?>
                                            <?php echo $this->Admin->iconEditLink(['action' => 'edit', $channel->id]); ?>
                                            <?php echo $this->Admin->iconDeleteLink(['action' => 'delete', $channel->id]); ?>
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
    </div>
</div>
<?php $this->append('pageScript'); ?>
<script>
    $(function(){
        $('.channel-level').each(function(){
            var $this = $(this);
            var level = $this.data('channelLevel');
            if (level > 0) {
                $this.css('padding-left', 20 * level);
            }
        });
    });
</script>
<?php $this->end(); ?>

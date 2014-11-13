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
                                        <th>文章数量</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($channels as $channel): ?>
                                    <tr>
                                        <td><?php echo $channel->id; ?></td>
                                        <td><?php echo h($channel->name); ?></td>
                                        <td><?php echo h($channel->channel_code); ?></td>
                                        <td><?php echo $channel->article_count; ?></td>
                                        <td>
                                            <?php echo $this->Admin->iconViewLink(['action' => 'view', $channel->id]); ?>
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

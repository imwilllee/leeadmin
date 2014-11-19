<div class="row">
    <div class="col-md-12">
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li class="active"><a href="javascript:;">附件一览</a></li>
                <li><?php echo $this->Html->link('上传附件', ['action' => 'upload']); ?></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active">
                    <div class="box box-primary">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <?php
                                        echo $this->Html->link(
                                                '<i class="fa fa-paperclip"></i> 全部附件',
                                                ['action' => 'index'],
                                                ['escape' => false, 'class' => 'btn btn-default btn-flat']
                                            );
                                    ?>
                                    <?php
                                        echo $this->Html->link(
                                                '<i class="fa fa-image"></i> 图片',
                                                ['action' => 'index', '?' => ['type' => 'image']],
                                                ['escape' => false, 'class' => 'btn btn-default btn-flat']
                                            );
                                    ?>
                                    <?php
                                        echo $this->Html->link(
                                                '<i class="fa fa-flash"></i> Flash',
                                                ['action' => 'index', '?' => ['type' => 'flash']],
                                                ['escape' => false, 'class' => 'btn btn-default btn-flat']
                                            );
                                    ?>
                                    <?php
                                        echo $this->Html->link(
                                                '<i class="fa fa-file-pdf-o"></i> PDF',
                                                ['action' => 'index', '?' => ['type' => 'pdf']],
                                                ['escape' => false, 'class' => 'btn btn-default btn-flat']
                                            );
                                    ?>
                                    <?php
                                        echo $this->Html->link(
                                                '<i class="fa fa-file-zip-o"></i> ZIP',
                                                ['action' => 'index', '?' => ['type' => 'zip']],
                                                ['escape' => false, 'class' => 'btn btn-default btn-flat']
                                            );
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="box box-primary">
                        <div class="box-body table-responsive no-padding">
                            <table class="table table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th style="width:40px;"><?php echo $this->Paginator->sort('id', '#'); ?></th>
                                        <th>上传文件名</th>
                                        <th>大小</th>
                                        <th>类型</th>
                                        <th>保存文件名</th>
                                        <th>上传日期</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($attachments as $attachment): ?>
                                    <tr>
                                        <td><?php echo $attachment->id; ?></td>
                                        <td>
                                        <?php if ($attachment->is_image): ?>
                                            <i class="fa fa-image"></i>
                                            <?php echo $this->Html->link($attachment->name, $attachment->preview_url, ['class' => 'fancybox-thumb', 'target' => '_blank', 'rel' => 'fancybox-thumb']); ?>
                                        <?php else: ?>
                                            <?php echo $this->Html->link($attachment->name, $attachment->preview_url, ['target' => '_blank']); ?>
                                        <?php endif; ?>
                                        </td>
                                        <td><?php echo size_format($attachment->size); ?></td>
                                        <td><?php echo h($attachment->type); ?></td>
                                        <td><?php echo h($attachment->save_name); ?></td>
                                        <td><?php echo df($attachment->created); ?></td>
                                        <td> <?php echo $this->Admin->iconDeleteLink(['action' => 'delete', $attachment->id]); ?></td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="box-footer clearfix">
            <?php echo $this->element('Admin/Common/pagination'); ?>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<?php echo $this->element('Admin/Common/Plugin/fancybox'); ?>

<?php $this->append('pageScript'); ?>
<script>
    $(document).ready(function() {
        $('.fancybox-thumb').fancybox();
    });
</script>
<?php $this->end(); ?>

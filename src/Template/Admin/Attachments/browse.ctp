<div class="row">
    <div class="col-md-12">
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li class="active"><a href="javascript:;">附件一览</a></li>
                <li><?php echo $this->Html->link('上传附件', ['action' => 'upload', $type, '?' => $this->request->query]); ?></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active">
                <?php if ($this->request->query('filter')): ?>
                    <div class="box box-primary">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <?php
                                        echo $this->Html->link(
                                                '<i class="fa fa-paperclip"></i> 全部附件',
                                                ['action' => 'index', '?' => array_merge($this->request->query, ['type' => false])],
                                                ['escape' => false, 'class' => 'btn btn-default btn-flat']
                                            );
                                    ?>
                                    <?php
                                        echo $this->Html->link(
                                                '<i class="fa fa-image"></i> 图片',
                                                ['action' => 'index', '?' => array_merge($this->request->query, ['type' => 'image'])],
                                                ['escape' => false, 'class' => 'btn btn-default btn-flat']
                                            );
                                    ?>
                                    <?php
                                        echo $this->Html->link(
                                                '<i class="fa fa-flash"></i> Flash',
                                                ['action' => 'index', '?' => array_merge($this->request->query, ['type' => 'flash'])],
                                                ['escape' => false, 'class' => 'btn btn-default btn-flat']
                                            );
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
                    <div class="box box-primary">
                        <div class="box-body table-responsive no-padding">
                            <table class="table table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th>上传文件名</th>
                                        <th>大小</th>
                                        <th>类型</th>
                                        <th>上传日期</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($attachments as $attachment): ?>
                                    <tr>
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
                                        <td><?php echo df($attachment->created); ?></td>
                                        <td>
                                            <?php
                                                echo $this->Html->link(
                                                        '<i class="fa fa-check"></i> 选择',
                                                        $attachment->preview_url,
                                                        ['escape' => false, 'class' => 'btn btn-primary btn-sm btn-flat item']
                                                    );
                                            ?>
                                        </td>
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
    $(function() {
        $('.fancybox-thumb').fancybox();
<?php if (!$this->request->query('fancybox')): ?>
        $('.item').on('click', function(e) {
            e.preventDefault();
            window.opener.CKEDITOR.tools.callFunction(<?php echo $this->request->query('CKEditorFuncNum'); ?>, $(this).attr('href'));
            window.close();
        });
<?php else: ?>
        $('.item').on('click', function(e) {
            e.preventDefault();
            parent.fancybox_callback($(this).attr('href'));
            parent.jQuery.fancybox.close();
        });
<?php endif; ?>
    });
</script>
<?php $this->end(); ?>

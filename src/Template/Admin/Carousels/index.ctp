<?php
    use Cake\Core\Configure;
?>
<div class="row">
    <div class="col-md-12">
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li class="active"><a href="javascript:;">KV图一览</a></li>
                <li><?php echo $this->Html->link('添加KV图', ['action' => 'edit']); ?></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active">

                    <div class="box box-primary">
                        <div class="box-body table-responsive no-padding">
                            <table class="table table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th><?php echo $this->Paginator->sort('Carousels.rank', '排序'); ?></th>
                                        <th><?php echo $this->Paginator->sort('Carousels.type_id', '类型'); ?></th>
                                        <th>名称</th>
                                        <th>链接</th>
                                        <th>图片路径</th>
                                        <th><?php echo $this->Paginator->sort('Carousels.created', '创建日期'); ?></th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($carousels as $carousel): ?>
                                    <tr>
                                        <td><?php echo $carousel->rank; ?></td>
                                        <td>
                                        <?php if ($carousel->type_id): ?>
                                            <?php echo  Configure::read('Carousels.type.' . $carousel->type_id); ?>
                                        <?php endif; ?>
                                        </td>
                                        <td><?php echo h($carousel->name); ?></td>
                                        <td><?php echo h($carousel->link); ?></td>
                                        <td>
                                        <?php
                                            echo $this->Html->link(
                                                $carousel->src,
                                                $carousel->src,
                                                ['class' => 'fancybox-thumb', 'rel' => 'fancybox-thumb']
                                            );
                                        ?>
                                        </td>
                                        <td><?php echo df($carousel->created); ?></td>
                                        <td>
                                            <?php echo $this->Admin->iconEditLink(['action' => 'edit', $carousel->id]); ?>
                                            <?php echo $this->Admin->iconDeleteLink(['action' => 'delete', $carousel->id]); ?>
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
    $(document).ready(function() {
        $('.fancybox-thumb').fancybox();
    });
</script>
<?php $this->end(); ?>

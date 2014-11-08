<div class="row">
    <div class="col-md-12">
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li class="active"><a href="javascript:;">文件一览</a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active">
                    <div class="box-header">
                        <?php echo $this->element('FileManager/breadcrumbs'); ?>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="alert alert-warning">删除系统目录或文件可能会造成不能正常运行，请慎重删除！</div>
                        </div>
                    </div>
                    <div class="box box-primary">
                        <div class="box-header">
                            <div class="box-tools">
                                <?php
                                    echo $this->Html->link(
                                            '<i class="fa fa-upload"></i> 上传文件',
                                            ['action' => 'upload', '?' => ['path' => urlencode($path)]],
                                            [
                                                'class' => 'btn btn-primary btn-flat',
                                                'escape' => false
                                            ]
                                        );
                                ?>
                                <?php
                                    echo $this->Html->link(
                                            '<i class="fa fa-folder-open-o"></i> 创建目录',
                                            ['action' => 'mkdir', '?' => ['path' => urlencode($path)]],
                                            [
                                                'class' => 'btn btn-default btn-flat iframe',
                                                'data-fancybox-type' => 'iframe',
                                                'escape' => false
                                            ]
                                        );
                                ?>
                                <?php
                                    echo $this->Html->link(
                                            '<i class="fa fa-refresh"></i> 刷新目录',
                                            ['action' => 'index', '?' => ['path' => urlencode($path)]],
                                            [
                                                'class' => 'btn btn-default btn-flat',
                                                'escape' => false
                                            ]
                                        );
                                ?>
                            </div>
                        </div>
                        <div class="box-body table-responsive no-padding">
                            <table class="table table-hover table-striped">
                                <?php if (!empty($files[0]) || !empty($files[1])): ?>
                                <?php $path = $path ? $path . DS : $path; ?>
                                <thead>
                                    <tr>
                                        <th style="width:30px;"></th>
                                        <th>目录内容</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($files[0] as $dir): ?>
                                        <?php $param = urlencode($path . $dir); ?>
                                    <tr>
                                        <td><i class="fa fa-1 fa-folder-o"></i></td>
                                        <td><?php echo $this->Html->link($dir, ['action' => 'index', '?' => ['path' => $param]]); ?></td>
                                        <td>
                                            <?php echo $this->Admin->iconLink('fa fa-1 fa-folder-open', ['action' => 'index', '?' => ['path' => $param]], ['data-original-title' => '打开']); ?>
                                            <?php echo $this->Admin->iconDeleteLink(['action' => 'delete', '?' => ['dir' => $param]]); ?>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                    <?php foreach ($files[1] as $filename): ?>
                                        <?php $param = urlencode($path . $filename); ?>
                                    <tr>
                                        <?php if ($this->Admin->checkImageFile($filename)): ?>
                                        <td>
                                        <i class="fa fa-1 fa-file-image-o"></i>
                                        </td>
                                        <td><?php echo $this->Html->link($filename, ['action' => 'preview', '?' => ['path' => $param]], ['class' => 'fancybox-thumb', 'target' => '_blank', 'rel' => 'fancybox-thumb' ]); ?></td>
                                        <td>
                                            <?php echo $this->Admin->iconLink('fa fa-1 fa-download', ['action' => 'download', '?' => ['path' => $param]], ['data-original-title' => '下载']); ?>
                                            <?php echo $this->Admin->iconDeleteLink(['action' => 'delete', '?' => ['file' => $param]]); ?>
                                        </td>
                                        <?php else: ?>
                                        <td>
                                        <i class="fa fa-1 fa-file-text-o"></i>
                                        </td>
                                        <td><?php echo h($filename); ?></td>
                                        <td>
                                            <?php echo $this->Admin->iconLink('fa fa-1 fa-download', ['action' => 'download', '?' => ['path' => $param]], ['data-original-title' => '下载']); ?>
                                            <?php echo $this->Admin->iconEditLink(['action' => 'edit', '?' => ['path' => $param]]); ?>
                                            <?php echo $this->Admin->iconDeleteLink(['action' => 'delete', '?' => ['file' => $param]]); ?>
                                        </td>
                                        <?php endif; ?>
                                    </tr>
                                    <?php endforeach; ?>
                                    </tbody>
                                <?php else: ?>
                                    <tr><td>该目录下没有内容！</td></tr>
                                <?php endif; ?>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<?php echo $this->element('Common/Plugin/fancybox'); ?>

<?php $this->append('pageScript'); ?>
<script>
    $(document).ready(function() {
        $('.fancybox-thumb').fancybox({
            prevEffect  : 'none',
            nextEffect  : 'none'
        });
        $('.iframe').fancybox({
            type: 'iframe',
            width: 500,
            iframe:{
                scrolling : 'auto',
                preload : true
            },
            'autoScale':false
        });
    });
</script>
<?php $this->end(); ?>

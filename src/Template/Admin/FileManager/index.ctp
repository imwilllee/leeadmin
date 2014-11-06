<div class="row">
    <div class="col-md-12">
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li class="active"><a href="javascript:;">文件一览</a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active">
                    <div class="box-header">
                            <ol class="breadcrumb">
                                <li><?php echo $this->Html->link('<i class="fa fa-1 fa-home"></i> 根目录', ['action' => 'index'], ['escape' => false]); ?></li>
                            <?php
                                $nav = null;
                                foreach ($breadcrumbs as $breadcrumb):
                                    $nav .= $nav === null ? $breadcrumb : DS . $breadcrumb;
                            ?>
                                <li><?php echo $this->Html->link($breadcrumb, ['action' => 'index', '?' => ['path' => urlencode($nav)]]); ?></li>
                            <?php endforeach; ?>
                            </ol>
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
                                            '在此上传文件',
                                            ['action' => 'upload', '?' => ['path' => urlencode($path)]],
                                            [
                                                'class' => 'btn btn-primary btn-flat'
                                            ]
                                        );
                                ?>
                                <a href="#" class="btn btn-default btn-flat" data-toggle="modal" data-target="#upload-modal">在此创建目录</a>
                            </div>
                        </div>
                        <div class="box-body table-responsive no-padding">
                            <table class="table table-hover table-striped">
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
                                        <td><?php echo $this->Html->link($filename, ['action' => 'preview', '?' => ['path' => $param]], ['class' => 'fancybox', 'target' => '_blank' ]); ?></td>
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
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="upload-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"><i class="fa fa-folder-o"></i> 创建目录</h4>
            </div>
            <form action="#" method="post">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-8 col-md-8 col-xs-12">
                                <div class="input-group">
                                    <span class="input-group-addon">TO:</span>
                                    <input name="email_to" type="email" class="form-control" placeholder="Email TO">
                                </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer clearfix">

                    <button type="button" class="btn btn-danger" data-dismiss="modal"> 取消</button>

                    <button type="submit" class="btn btn-primary pull-left"> 保存</button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<?php echo $this->element('Common/Plugin/fancybox'); ?>

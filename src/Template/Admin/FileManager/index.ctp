<div class="row">
    <div class="col-md-12">
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li class="active"><a href="javascript:;">文件一览</a></li>
                <li><?php echo $this->Html->link('上传文件', ['action' => 'upload']); ?></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active">
                        <div class="box-header">
                                <ol class="breadcrumb">
                                    <li><?php echo $this->Html->link('<i class="fa fa-1 fa-home"></i> wwwroot', ['action' => 'index'], ['escape' => false]); ?></li>
                                <?php
                                    $nav = null;
                                    foreach ($breadcrumbs as $breadcrumb):
                                        $nav .= $nav === null ? $breadcrumb : DS . $breadcrumb;
                                ?>
                                    <li><?php echo $this->Html->link($breadcrumb, ['action' => 'index', '?' => ['pwd' => urlencode($nav)]]); ?></li>
                                <?php endforeach; ?>
                                </ol>
                        </div>

                    <div class="box box-primary">
                        <div class="box-header">
                            <div class="box-tools">
                                <a href="javascript:;" class="btn btn-primary btn-flat">在此上传</a>
                                <a href="javascript:;" class="btn btn-default btn-flat">创建目录</a>
                                <a href="javascript:;" class="btn btn-default btn-flat">新建文件</a>
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
                                        <?php $path = urlencode($pwd . $dir); ?>
                                    <tr>
                                        <td><i class="fa fa-1 fa-folder-o"></i></td>
                                        <td><?php echo $this->Html->link($dir, ['action' => 'index', '?' => ['pwd' => $path]]); ?></td>
                                        <td>
                                            <?php echo $this->Admin->iconLink('fa fa-1 fa-folder-open', ['action' => 'index', '?' => ['pwd' => $path]], ['data-original-title' => '打开']); ?>
                                            <?php echo $this->Admin->iconDeleteLink(['action' => 'delete', '?' => ['pwd' => $path]]); ?>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                    <?php foreach ($files[1] as $file): ?>
                                    <tr>
                                        <td><i class="fa fa-1 fa-file-text-o"></i></td>
                                        <td><?php echo h($file); ?></td>
                                        <td>
                                            <?php $path = urlencode($pwd . $file); ?>
                                            <?php echo $this->Admin->iconEditLink(['action' => 'edit', '?' => ['path' => $path]]); ?>
                                            <?php echo $this->Admin->iconDeleteLink(['action' => 'delete', '?' => ['path' => $path]]); ?>
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

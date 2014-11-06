<div class="row">
    <div class="col-md-12">
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li><?php echo $this->Html->link('文件一览', ['action' => 'index']); ?></li>
                <li class="active"><a href="javascript:;">文件编辑</a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active">
                        <div class="box-header">
                                <ol class="breadcrumb">
                                    <li><?php echo $this->Html->link('<i class="fa fa-1 fa-home"></i> 根目录', ['action' => 'index'], ['escape' => false]); ?></li>
                                <?php
                                    $nav = null;
                                    $length = count($breadcrumbs) - 1;
                                ?>
                                <?php foreach ($breadcrumbs as $key => $breadcrumb): ?>
                                <?php if ($key !== $length): ?>
                                    <?php $nav .= $nav === null ? $breadcrumb : DS . $breadcrumb; ?>
                                    <li><?php echo $this->Html->link($breadcrumb, ['action' => 'index', '?' => ['path' => urlencode($nav)]]); ?></li>
                                <?php else:?>
                                    <li class="active"><?php echo h($breadcrumb); ?></li>
                                <?php endif;?>
                                <?php endforeach; ?>
                                </ol>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="alert alert-warning">一些系统文件修改可能会造成系统不能正常运行，请慎重修改！</div>
                            </div>
                        </div>
                    <?php echo $this->Form->create(null, ['url' => ['action' => 'edit']]); ?>
                        <?php echo $this->Form->hidden('path', ['value' => $path]); ?>
                        <div class="box box-solid box-primary">
                            <div class="box-header">
                                <h3 class="box-title">文件内容</h3>
                                <div class="box-tools pull-right">
                                    <button type="button" class="btn btn-primary btn-xs" data-widget="collapse" data-toggle="tooltip" data-original-title="关闭"><i class="fa fa-minus"></i></button>
                                </div>
                            </div>
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-xs-12">
                                        <div class="form-group">
                                            <?php
                                                echo $this->Form->textarea(
                                                    'content',
                                                    [
                                                        'class' => 'form-control',
                                                        'placeholder' => '文件内容',
                                                        'rows' => 20,
                                                        'value' => $content
                                                    ]
                                                );
                                            ?>
                                        </div>
                                    </div>
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

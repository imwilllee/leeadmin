<?php echo $this->Form->create(null, ['url' => ['action' => 'mkdir']]); ?>
    <?php echo $this->Form->hidden('path', ['value' => $path]); ?>
    <div class="row">
        <div class="col-xs-12">
            <div class="form-group<?php echo $this->Admin->errorClass('dir_name', $errors); ?>">
                <label>目录名称</label>
                <?php echo $this->Form->text('dir_name', ['class' => 'form-control', 'placeholder' => '目录名称']); ?>
                <span class="text-light-blue">不支持中文或者特殊字符作为目录名称。</span>
                <?php echo $this->Admin->error('dir_name', $errors); ?>
            </div>
        </div>
    </div>
    <button class="btn btn-primary btn-flat"><i class="fa fa-save"></i> 保存</button>
    <a href="javascript:parent.$.fancybox.close();" class="btn btn-danger btn-flat"><i class="fa fa-close"></i> 关闭</a>
<?php echo $this->Form->end(); ?>

<?php
    use Cake\Routing\Router;
?>
<div class="row">
    <div class="col-md-12">
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li><?php echo $this->Html->link('文件一览', ['action' => 'index']); ?></li>
                <li class="active"><a href="javascript:;">上传文件</a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active">
                    <div class="box-header">
                        <?php echo $this->element('Explorer.Admin/breadcrumbs'); ?>
                    </div>
                    <?php echo $this->Form->create(null, ['url' => ['action' => 'upload'], 'id' => 'fileupload', 'type' => 'file']); ?>
                    <?php echo $this->Form->unlockField('files'); ?>
                    <?php echo $this->Form->hidden('path', ['value' => $path]); ?>
                    <div class="box box-primary">
                        <div class="box-header">
                            <div class="box-tools">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <?php
                                            echo $this->Html->link(
                                                    '<i class="fa fa-reply"></i> 返回目录',
                                                    ['action' => 'index', '?' => ['path' => $path]],
                                                    ['class' => 'btn btn-default btn-flat', 'escape' => false]
                                                );
                                        ?>
                                        <span class="btn btn-primary btn-flat fileinput-button">
                                            <i class="fa fa-plus"></i>
                                            <span>添加文件</span>
                                            <?php echo $this->Form->file('files[]', ['multiple' => true]); ?>
                                        </span>
                                        <button type="button" class="btn btn-success btn-flat start-all">
                                            <i class="fa fa-upload"></i>
                                            <span>全部上传</span>
                                        </button>
                                        <button type="button" class="btn btn-danger btn-flat delete-all">
                                            <i class="fa fa-ban"></i>
                                            <span>全部删除</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="box-body table-responsive no-padding">
                            <table class="table table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th>文件名</th>
                                        <th>文件类型</th>
                                        <th>大小</th>
                                        <th>上传进度</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody class="files"></tbody>
                            </table>
                        </div>
                    </div>
                    <?php echo $this->Form->end(); ?>

                </div>
            </div>
        </div>
    </div>
</div>

<?php echo $this->element('Admin/Common/Plugin/fancybox'); ?>
<?php echo $this->element('Admin/Common/Plugin/fileupload_more'); ?>
<?php $this->append('pageScript'); ?>
<!-- 上传文件预览模板 -->
<script id="template-upload" type="text/x-tmpl">
{% for (var i=0, file; file=o.files[i]; i++) { %}
    <tr>
        <td>
            {%=file.name%}
            {% if (file.error) { %}
            <p class="text-red">{%=file.error%}</p>
            {% } %}
        </td>
        <td>
            {%=file.type%}
        </td>
        <td>
            {%=formatFileSize(file.size)%}
        </td>
        <td>
            {% if (!file.error) { %}

            <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
                <div class="progress-bar progress-bar-success" style="width:0%;"></div>
            </div>
            {% } %}
        </td>
        <td>
            {% if (!i) { %}
                {% if (!file.error) { %}
                <button type="button" class="btn btn-primary btn-sm btn-flat start">
                    <i class="fa fa-upload"></i>
                    <span>上传</span>
                </button>
                {% } %}
                <button type="button" class="btn btn-danger btn-sm btn-flat delete">
                    <i class="fa fa-ban"></i>
                    <span>删除</span>
                </button>
            {% } %}
        </td>
    </tr>
{% } %}
</script>

<!-- 上传完毕文件模板 -->
<script id="template-download" type="text/x-tmpl">
{% for (var i=0, file; file=o.files[i]; i++) { %}
    <tr>
        <td>
            {% if (file.previewUrl) { %}
                <a href="{%=file.previewUrl%}" class="preview" title="{%=rawurldecode(file.name)%}">{%=rawurldecode(file.name)%}</a>
            {% } else { %}
                {%=rawurldecode(file.name)%}
            {% } %}
            {% if (file.error) { %}
            <p class="text-red">{%=file.error%}</p>
            {% } %}
        </td>
        <td>
            {%=file.type%}
        </td>
        <td>
            {%=formatFileSize(file.size)%}
        </td>
        <td>
            {% if (file.error) { %}
                <span class="label label-danger">上传失败</span>
            {% } else { %}
                <span class="label label-primary">上传成功</span>
            {% } %}
        </td>

        <td>
            {% if (file.error) { %}
                <button type="button" class="btn btn-danger btn-sm btn-flat delete">
                    <i class="fa fa-ban"></i>
                    <span>删除</span>
                </button>
            {% } %}
        </td>
    </tr>
{% } %}
</script>

<script>
    $(function(){
        $('.start-all').on('click', function(e) {
            e.preventDefault();
            $('.start').trigger('click');
        });
        $('.delete-all').on('click', function(e) {
            e.preventDefault();
            $('.delete').trigger('click');
        });

        $('#fileupload').fileupload({
            url: '<?php echo Router::url(['action' => 'upload']); ?>',
            dataType: 'json',
            autoUpload: false,
            //acceptFileTypes: /(\.|\/)(gif|jpe?g|png)$/i,
            //maxFileSize: 5000000
        }).on('fileuploadadd', function (e, data) {
            // TODO
        }).on('fileuploadprocessalways', function (e, data) {
            data.context = $(tmpl('template-upload', data));

            data.context.find('.delete').on('click', function (e) {
                e.preventDefault();
                data.context.fadeOut('slow', function(){
                    data.context.remove();
                })
            });
            data.context.find('.start').on('click', function (e) {
                e.preventDefault();
                $(this).prop('disabled', true);
                data.submit();
            });
            data.context.fadeIn('slow').appendTo('.files');
        }).on('fileuploadprogress', function (e, data) {
            if (e.isDefaultPrevented()) {
                return false;
            }
            var progress = Math.floor(data.loaded / data.total * 100);
            if (data.context) {
                data.context.each(function () {
                    $(this).find('.progress')
                        .attr('aria-valuenow', progress)
                        .children().first().css('width', progress + '%');
                });
            }
        }).on('fileuploaddone', function (e, data) {
            var tpl = $(tmpl('template-download', data.result));
            tpl.find('.delete').click(function (e) {
                e.preventDefault();
                tpl.fadeOut('slow', function(){
                    tpl.remove();
                });
            });
            tpl.find('.preview').fancybox({
                helpers: {
                  title : {
                      type : 'float'
                  }
                }
            });
            data.context.replaceWith(tpl);
            data.context = tpl;
        }).on('fileuploadfail', function (e, data) {
            data.context.find('.start').remove();
            $.each(data.files, function (i) {
                $(data.context.find('td:eq(0)')[i]).append($('<p class="text-red"/>').text('上传发生错误！'));
                $(data.context.find('td:eq(3)')[i]).html($('<span class="label label-danger"/>').text('上传失败'));
            });
        });
    });
</script>

<?php $this->end(); ?>

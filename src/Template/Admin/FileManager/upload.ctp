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
                        <?php echo $this->element('FileManager/breadcrumbs'); ?>
                    </div>
                    <?php echo $this->Form->create(null, ['url' => ['action' => 'upload'], 'id' => 'fileupload', 'type' => 'file']); ?>
                    <?php echo $this->Form->hidden('path', ['value' => urlencode($path)]); ?>
                    <div class="box box-primary">
                        <div class="box-header">
                            <div class="box-tools">
                                <div class="row fileupload-buttonbar">
                                    <div class="col-lg-7">
                                        <span class="btn btn-success btn-flat fileinput-button">
                                            <i class="fa fa-plus"></i>
                                            <span>添加文件</span>
                                            <?php echo $this->Form->file('files[]', ['multiple' => true]); ?>
                                        </span>
                                        <button type="submit" class="btn btn-primary btn-flat start">
                                            <i class="fa fa-upload"></i>
                                            <span>开始上传</span>
                                        </button>
                                        <button type="reset" class="btn btn-warning btn-flat cancel">
                                            <i class="fa fa-ban"></i>
                                            <span>取消上传</span>
                                        </button>
                                        <button type="button" class="btn btn-danger btn-flat delete">
                                            <i class="fa fa-trash"></i>
                                            <span>删除</span>
                                        </button>
                                        <span class="fileupload-process"></span>
                                    </div>
                                    <div class="col-lg-5 fileupload-progress fade">
                                        <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100">
                                            <div class="progress-bar progress-bar-success" style="width:0%;"></div>
                                        </div>
                                        <div class="progress-extended">&nbsp;</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="box-body table-responsive no-padding">
                            <table role="presentation" class="table table-striped"><tbody class="files"></tbody></table>
                        </div>
                    </div>
                    <?php echo $this->Form->end(); ?>

                </div>
            </div>
        </div>
    </div>
</div>

<?php echo $this->element('Common/Plugin/fancybox'); ?>
<?php echo $this->element('Common/Plugin/fileupload'); ?>
<?php $this->append('pageScript'); ?>
<!-- The template to display files available for upload -->
<script id="template-upload" type="text/x-tmpl">
{% for (var i=0, file; file=o.files[i]; i++) { %}
    <tr class="template-upload fade">
        <td>
            <span class="preview"></span>
        </td>
        <td>
            <p class="name">{%=file.name%}</p>
            <strong class="error text-danger"></strong>
        </td>
        <td>
            <p class="size">Processing...</p>
            <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0"><div class="progress-bar progress-bar-success" style="width:0%;"></div></div>
        </td>
        <td>
            {% if (!i && !o.options.autoUpload) { %}
                <button class="btn btn-primary btn-flat start" disabled>
                    <i class="fa fa-upload"></i>
                    <span>上传</span>
                </button>
            {% } %}
            {% if (!i) { %}
                <button class="btn btn-warning btn-flat cancel">
                    <i class="fa fa-ban"></i>
                    <span>取消</span>
                </button>
            {% } %}
        </td>
    </tr>
{% } %}
</script>
<!-- The template to display files available for download -->
<script id="template-download" type="text/x-tmpl">
{% for (var i=0, file; file=o.files[i]; i++) { %}
    <tr class="template-download fade">
        <td>
            <span class="preview">
                {% if (file.thumbnailUrl) { %}
                    <a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" data-gallery><img src="{%=file.thumbnailUrl%}"></a>
                {% } %}
            </span>
        </td>
        <td>
            <p class="name">
                {% if (file.url) { %}
                    <a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" {%=file.thumbnailUrl?'data-gallery':''%}>{%=file.name%}</a>
                {% } else { %}
                    <span>{%=file.name%}</span>
                {% } %}
            </p>
            {% if (file.error) { %}
                <div><span class="label label-danger">Error</span> {%=file.error%}</div>
            {% } %}
        </td>
        <td>
            <span class="size">{%=o.formatFileSize(file.size)%}</span>
        </td>
        <td>
            {% if (file.deleteUrl) { %}
                <button class="btn btn-danger btn-flat delete" data-type="{%=file.deleteType%}" data-url="{%=file.deleteUrl%}"{% if (file.deleteWithCredentials) { %} data-xhr-fields='{"withCredentials":true}'{% } %}>
                    <i class="fa fa-trash"></i>
                    <span>删除</span>
                </button>
            {% } else { %}
                <button class="btn btn-warning btn-flat cancel">
                    <i class="fa fa-ban"></i>
                    <span>取消</span>
                </button>
            {% } %}
        </td>
    </tr>
{% } %}
</script>
<script>
    $(function() {
        $('#fileupload').fileupload();
    });
</script>
<?php $this->end(); ?>

<?php
    $this->append('importCss');
    echo $this->Html->css([
            'plugins/fileupload/css/jquery.fileupload'
        ]);
    $this->end();
?>

<?php
    $this->append('importScript');
    echo $this->Html->script([
            'plugins/fileupload/vendor/jquery.ui.widget',
            'tmpl.min',
            'jquery.blueimp-gallery.min',
            'plugins/fileupload/jquery.iframe-transport',
            'plugins/fileupload/jquery.fileupload',
            'plugins/fileupload/jquery.fileupload-process',
            'plugins/fileupload/jquery.fileupload-validate'
        ]);
    $this->end();
?>


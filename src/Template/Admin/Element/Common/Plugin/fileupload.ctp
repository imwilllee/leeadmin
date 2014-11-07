<?php $this->append('importCss'); ?>
<?php
    echo $this->Html->css([
            'plugins/fileupload/css/jquery.fileupload',
            'plugins/fileupload/css/jquery.fileupload-ui'
        ]);
?>
<noscript><?php echo $this->Html->css('plugins/fileupload/css/fileupload-noscript'); ?></noscript>
<noscript><?php echo $this->Html->css('plugins/fileupload/css/fileupload-ui-noscript'); ?></noscript>
<?php $this->end(); ?>

<?php $this->append('importScript'); ?>
<?php
    echo $this->Html->script([
            'plugins/fileupload/vendor/jquery.ui.widget',
            'tmpl.min',
            'load-image.all.min',
            'canvas-to-blob.min',
            'jquery.blueimp-gallery.min',
            'plugins/fileupload/jquery.iframe-transport',
            'plugins/fileupload/jquery.fileupload',
            'plugins/fileupload/jquery.fileupload-process',
            'plugins/fileupload/jquery.fileupload-image',
            'plugins/fileupload/jquery.fileupload-audio',
            'plugins/fileupload/jquery.fileupload-video',
            'plugins/fileupload/jquery.fileupload-validate',
            'plugins/fileupload/jquery.fileupload-ui'
        ]);
?>
<!--[if (gte IE 8)&(lt IE 10)]>
<script src="js/cors/jquery.xdr-transport.js"></script>
<?php echo $this->Html->script('plugins/fileupload/cors/jquery.xdr-transport'); ?>
<![endif]-->
<?php $this->end(); ?>

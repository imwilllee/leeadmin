<?php
    $this->append('importCss');
    echo $this->Html->css('plugins/fancybox/jquery.fancybox');
    $this->end();
    $this->append('importScript');
    echo $this->Html->script('plugins/fancybox/jquery.fancybox.pack');
    $this->end();
?>
<?php $this->append('pageScript'); ?>
<script>
    $(document).ready(function() {
        $('.fancybox').fancybox();
    });
</script>
<?php $this->end(); ?>

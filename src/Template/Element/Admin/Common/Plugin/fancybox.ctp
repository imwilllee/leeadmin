<?php
    $this->append('importCss');
    echo $this->Html->css('plugins/fancybox/jquery.fancybox');
    $this->end();
    $this->append('importScript');
    echo $this->Html->script('plugins/fancybox/jquery.fancybox.pack');
    $this->end();
?>

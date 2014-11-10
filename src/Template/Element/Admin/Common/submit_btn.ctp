<?php
    if (empty($returnUrl)):
        $returnUrl = ['action' => 'index'];
    endif;
?>
                    <?php echo $this->Html->link('<i class="fa fa-reply"></i> 返回', $returnUrl, ['class' => 'btn btn-default btn-flat', 'escape' => false]); ?>
                    <button class="btn btn-primary btn-flat"><i class="fa fa-save"></i> 保存</button>

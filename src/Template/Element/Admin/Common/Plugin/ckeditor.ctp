<?php
    use Cake\Routing\Router;
?>
<?php
    $this->append('importScript');
    echo $this->Html->script('plugins/ckeditor/ckeditor');
    echo $this->Html->script('plugins/ckeditor/adapters/jquery');
    $this->end();
?>
<?php $this->append('pageScript'); ?>
<script>
    $(function(){
        $('.editor').ckeditor({
            uiColor: '#FAFAFA',
            filebrowserBrowseUrl: '<?php echo Router::url(['plugin' => false, 'controller' => 'Attachments', 'action' => 'index']); ?>',
            filebrowserUploadUrl: '<?php echo Router::url(['plugin' => false, 'controller' => 'Attachments', 'action' => 'upload']); ?>',
            filebrowserImageBrowseLinkUrl: '<?php echo Router::url(['plugin' => false, 'controller' => 'Attachments', 'action' => 'index', 'image']); ?>',
            filebrowserImageBrowseUrl: '<?php echo Router::url(['plugin' => false, 'controller' => 'Attachments', 'action' => 'index', 'image']); ?>',
            filebrowserImageUploadUrl: '<?php echo Router::url(['plugin' => false, 'controller' => 'Attachments', 'action' => 'upload', 'image']); ?>',
            filebrowserFlashBrowseUrl: '<?php echo Router::url(['plugin' => false, 'controller' => 'Attachments', 'action' => 'index', 'flash']); ?>',
            filebrowserFlashUploadUrl: '<?php echo Router::url(['plugin' => false, 'controller' => 'Attachments', 'action' => 'upload', 'flash']); ?>'
        });
    });
</script>
<?php $this->end(); ?>

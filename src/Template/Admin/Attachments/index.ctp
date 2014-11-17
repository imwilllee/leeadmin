<a href="/uploads/images/2014/11/17/1a7f6040101cb3054c797582b62591eb.jpg" class="item">选择</a>

<a href="/uploads/images/2014/11/17/e24ed8b3296ede3296fa93b9a58804ec.jpg" class="item">选择</a>
<?php $this->append('pageScript'); ?>
<script>
    $(function(){
        $('.item').on('click', function(e) {
            e.preventDefault();
            window.opener.CKEDITOR.tools.callFunction(<?php echo $this->request->query('CKEditorFuncNum'); ?>, $(this).attr('href'));
            window.close();
        });
    });
</script>
<?php $this->end(); ?>

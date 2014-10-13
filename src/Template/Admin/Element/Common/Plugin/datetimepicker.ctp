
        <?php
            $this->append('importScript');
            echo $this->Html->script('plugins/laydate/laydate');
            $this->end();
        ?>
<?php $this->append('pageScript'); ?>
<script>
    $(function(){
        $('.datepicker').on('click', function(){
            laydate({elem: '#' + $(this).attr('data-target-id'), format: 'YYYY-MM-DD'});
        });
        $('.datetimepicker').on('click', function(){
            laydate({elem: '#' + $(this).attr('data-target-id'), istime: true, format: 'YYYY-MM-DD hh:mm:ss'});
        });
    });
</script>
<?php $this->end(); ?>

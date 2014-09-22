
        <?php
            $this->append('importScript');
            echo $this->Html->script('plugins/My97DatePicker/WdatePicker');
            $this->end();
        ?>
<?php $this->append('pageScript'); ?>
<script>
    $(function(){
        $('.datepicker').on('click', function(){
            WdatePicker({
                el: $(this).attr('data-target-id')
            });
        });
        $('.datetimepicker').on('click', function(){
            WdatePicker({
                el: $(this).attr('data-target-id'),
                dateFmt: 'yyyy-MM-dd HH:mm:ss',
                hmsMenuCfg: {
                     H: [1, 6], m: [1, 8], s: [1, 8] 
                }
            });
        });
    });
</script>
<?php $this->end(); ?>
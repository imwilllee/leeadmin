                <div class="row">
                    <div class="col-xs-6 col-md-6" style="padding-top:5px;">
                        <?php echo $this->Paginator->counter('当前{{page}}/{{pages}}页 共{{count}}条记录'); ?>
                    </div>
                    <div class="col-xs-6 col-md-6">
                        <ul class="pagination pull-right pagination-sm no-margin">
                        <?php
                            echo $this->Paginator->prev('上一页');
                            echo $this->Paginator->numbers();
                            echo $this->Paginator->next('下一页');
                        ?>
                        </ul>
                    </div>
                </div>
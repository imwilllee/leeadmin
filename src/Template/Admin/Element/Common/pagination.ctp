                <div class="row">
                    <div class="col-md-6">
                        <?php echo $this->Paginator->counter('当前第{{page}}页，共{{pages}}页 显示{{current}}条记录，共{{count}}条记录'); ?>
                    </div>
                    <div class="col-md-6">
                        <ul class="pagination pull-right pagination-sm no-margin">
                        <?php
                            echo $this->Paginator->prev('上一页');
                            echo $this->Paginator->numbers();
                            echo $this->Paginator->next('下一页');
                        ?>
                        </ul>
                    </div>
                </div>
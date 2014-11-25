<?php
    use Cake\Core\Configure;
?>
<div class="row">
    <div class="col-md-12">
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li><?php echo $this->Html->link('留言一览', ['action' => 'index']); ?></li>
                <li class="active"><a href="javascript:;">留言详细</a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active">
                    <div class="box box-solid box-primary">
                        <div class="box-header">
                            <h3 class="box-title">详细信息</h3>
                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-primary btn-xs" data-widget="collapse" data-toggle="tooltip" data-original-title="关闭"><i class="fa fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="box-body">
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="form-group">
                                        <label>姓名</label>
                                        <p><?php echo h($contact->name); ?></p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="form-group">
                                        <label>电话号码</label>
                                        <p><?php echo h($contact->mobile); ?></p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="form-group">
                                        <label>电子邮箱</label>
                                        <p><?php echo h($contact->email); ?></p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="form-group">
                                        <label>资料类型</label>
                                        <p>
                                            <?php
                                                if ($contact->type_id):
                                                    echo Configure::read('Contacts.type.' . $contact->type_id);
                                                else:
                                                    echo '无';
                                                endif;
                                            ?>
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="form-group">
                                        <label>公司名</label>
                                        <p>
                                        <?php echo h($contact->subject); ?>
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="form-group">
                                        <label>留言时间</label>
                                        <p>
                                        <?php echo df($contact->created); ?>
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="form-group">
                                        <label>留言内容</label>
                                        <p><?php echo nl2br(h($contact->content)); ?></p>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <?php echo $this->element('Admin/Common/view_btn'); ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
    use Cake\Core\Configure;
?>

<div class="row">
    <div class="col-md-12">
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li class="active"><a href="javascript:;">留言一览</a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active">

                    <div class="box box-primary collapsed-box">
                    <?php echo $this->Form->create(null, ['url' => ['action' => 'index']]); ?>
                        <div class="box-header">
                            <div class="box-tools">
                                <div class="row">
                                    <div class="col-xs-10">
                                        <div class="pull-left">
                                            <div class="input-group col-lg-5 col-md-8 col-xs-12">
                                                <?php echo $this->Form->text('q', ['class' => 'form-control', 'placeholder' => '姓名或公司名']); ?>
                                                <span class="input-group-btn">
                                                    <button class="btn btn-primary btn-flat"><i class="fa fa-search"></i> 数据检索</button>
                                                </span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-xs-2">
                                        <div class="pull-right">
                                            <button type="button" id="box-collapse" class="btn btn-primary btn-xs" data-widget="collapse" data-toggle="tooltip" data-original-title="显示"><i class="fa fa-plus"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="box-body" style="display: none;">
                            <div class="row">
                                <div class="col-lg-3 col-md-3 col-xs-12">
                                    <div class="form-group">
                                        <label>邮箱</label>
                                        <?php echo $this->Form->text('email', ['class' => 'form-control', 'placeholder' => '邮箱']); ?>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-3 col-xs-12">
                                    <div class="form-group">
                                        <label>电话号码</label>
                                        <?php echo $this->Form->text('mobile', ['class' => 'form-control', 'placeholder' => '电话号码']); ?>
                                    </div>
                                </div>

                                <div class="col-lg-3 col-md-3 col-xs-12">
                                    <div class="form-group">
                                        <label>状态</label>
                                        <div class="input-group">
                                            <?php echo $this->Form->multiCheckbox('notify_flg', Configure::read('Contacts.notify')); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-3 col-xs-12">
                                    <div class="form-group">
                                        <label>资料类型</label>
                                        <div class="input-group">
                                            <?php echo $this->Form->multiCheckbox('type_id', Configure::read('Contacts.type')); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6 col-md-12 col-xs-12">
                                    <div class="form-group">
                                        <label>留言时间</label>
                                        <div class="input-group">
                                            <div class="col-lg-6 col-md-6 col-xs-6 no-padding">
                                                <div class="input-group">
                                                    <?php echo $this->Form->text('start_date', ['id' => 'start_date', 'class' => 'form-control', 'placeholder' => '开始日期']); ?>
                                                    <div class="input-group-addon datetimepicker" data-target-id="start_date">
                                                    <i class="fa fa-calendar"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-xs-6">
                                                <div class="input-group">
                                                    <?php echo $this->Form->text('end_date', ['id' => 'end_date', 'class' => 'form-control datetimepicker', 'placeholder' => '结束日期']); ?>
                                                    <div class="input-group-addon datetimepicker" data-target-id="end_date">
                                                    <i class="fa fa-calendar"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>



                            </div>
                        </div>
                        <div class="box-footer" style="display: none;">
                            <button class="btn btn-primary btn-flat"><i class="fa fa-search"></i> 数据检索</button>
                        </div>
                    <?php echo $this->Form->end(); ?>
                    </div>
                    <div class="box box-primary">
                        <div class="box-header">
                            <div class="box-tools">
                                <?php echo $this->Html->link('已读', ['action' =>'attribute', 'read'], ['class' => 'btn btn-primary btn-flat batch-action']); ?>
                                <?php echo $this->Html->link('未读', ['action' =>'attribute', 'unread'], ['class' => 'btn btn-danger btn-flat batch-action']); ?>
                            </div>
                        </div>
                        <div class="box-body table-responsive no-padding">
                            <table class="table table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th style="width:25px;">
                                            <input type="checkbox" id="checkbox-selector" data-target-selector="id[]">
                                        </th>
                                        <th><?php echo $this->Paginator->sort('Contacts.notify_flg', '状态'); ?></th>
                                        <th>姓名</th>
                                        <th>公司名</th>
                                        <th>电话号码</th>
                                        <th>电子邮箱</th>
                                        <th>资料类型</th>
                                        <th><?php echo $this->Paginator->sort('Contacts.created', '留言时间'); ?></th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($contacts as $contact): ?>
                                    <tr>
                                        <td><?php echo $this->Form->checkbox('id', ['value' => $contact->id, 'name' => 'id[]']); ?></td>
                                        <td>
                                        <?php if ($contact->notify_flg): ?>
                                            <span class="label label-primary"><?php echo Configure::read('Contacts.notify.1'); ?></span>
                                        <?php else: ?>
                                            <span class="label label-danger"><?php echo Configure::read('Contacts.notify.0'); ?></span>
                                        <?php endif; ?>
                                        </td>
                                        <td><?php echo h($contact->name); ?></td>
                                        <td><?php echo h($contact->subject); ?></td>
                                        <td><?php echo h($contact->mobile); ?></td>
                                        <td><?php echo h($contact->email); ?></td>
                                        <td>
                                        <?php if ($contact->type_id): ?>
                                            <?php echo Configure::read('Contacts.type.' . $contact->type_id); ?>
                                        <?php else: ?>
                                            无
                                        <?php endif; ?>
                                        </td>
                                        <td><?php echo df($contact->created); ?></td>
                                        <td>
                                            <?php echo $this->Admin->iconViewLink(['action' => 'view', $contact->id]); ?>
                                            <?php echo $this->Admin->iconDeleteLink(['action' => 'delete', $contact->id]); ?>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="box-footer clearfix">
            <?php echo $this->element('Admin/Common/pagination'); ?>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<?php $this->append('pageScript'); ?>
<script>
    $(function(){
        $('.batch-action').on('click', function(){
            var items = get_checked_items('id[]');
            if ($.isEmptyObject(items)) {
                alert('至少选择一个项目！');
                return false;
            }
            if (confirm('确认更改状态？')) {
                location.href = $(this).attr('href') + '?id=' +items.join('_');
            }
            return false;
        });
    });
</script>
<?php $this->end(); ?>
<?php echo $this->element('Admin/Common/Plugin/datetimepicker'); ?>

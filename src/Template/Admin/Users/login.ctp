<?php $this->append('pageStyle'); ?>
        <style type="text/css">
            html,body{background-color: #3c8dbc !important;}
        </style>
<?php $this->end(); ?>
<!DOCTYPE html>
<html>
<?php echo $this->element('Common/head'); ?>
    <body>
        <div class="form-box">
            <div class="header">管理员登陆</div>
            <?php echo $this->Form->create(null); ?>

                <div class="body bg-gray">
<?php if ($this->Session->check('Flash.flash')) : ?>
                    <div class="form-group">
<?php echo $this->Flash->render(); ?>
                    </div>
<?php endif;?>
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                            <?php echo $this->Form->text('email', ['class' => 'form-control', 'placeholder' => '邮箱']); ?>

                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
                            <?php echo $this->Form->password('password', ['class' => 'form-control', 'placeholder' => '密码']); ?>

                        </div>
                    </div>
                </div>
                <div class="footer">
                    <button type="submit" class="btn btn-lg btn-primary btn-block btn-flat">登陆系统</button>
                </div>
            <?php echo $this->Form->end(); ?>

        </div>
    </body>
</html>
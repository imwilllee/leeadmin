        <div class="form-box" id="login-box">
            <div class="header">Sign In</div>
            <form action="" method="post">
                <div class="body bg-gray">
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                            <input name="email" class="form-control" placeholder="邮箱" type="text">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
                            <input name="password" class="form-control" placeholder="密码" type="text">
                        </div>
                    </div>
                </div>
                <div class="footer">
                    <button type="submit" class="btn btn-lg btn-primary btn-block btn-flat">登陆系统</button>
                </div>
            </form>
        </div>
<?php $this->append('head'); ?>
        <style type="text/css">
            html,body{background-color: #3c8dbc !important;}
        </style>
<?php $this->end(); ?>
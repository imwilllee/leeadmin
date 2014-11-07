        <header class="header">
            <?php
                echo $this->Html->link(
                    'LeeAdmin',
                    ['plugin' => false, 'controller' => 'Dashboard', 'action' => 'index'],
                    ['class' => 'logo']
                );
            ?>
            <nav class="navbar navbar-static-top" role="navigation">
                <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
                <div class="navbar-right">
                    <ul class="nav navbar-nav">
                        <li class="dropdown user user-menu">
                            <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-user"></i>
                                <?php echo $this->Session->read('Auth.User.alias'); ?> <i class="caret"></i>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="user-header bg-light-blue">
                                    <img src="/img/no_avatar.png" class="img-circle" alt="User Image" />
                                    <p>
                                        <?php echo h($this->Session->read('Auth.User.alias')); ?>
                                        <small><?php echo h($this->Session->read('Auth.User.group.name')); ?></small>
                                    </p>
                                </li>
                                <li class="user-body">
                                    <div class="col-xs-6 text-center">
                                        <?php
                                            echo $this->Html->link(
                                                '个人信息',
                                                ['plugin' => false, 'controller' => 'Users', 'action' => 'view', $this->Session->read('Auth.User.id')]
                                            );
                                        ?>
                                    </div>
                                    <div class="col-xs-6 text-center">
                                        <?php
                                            echo $this->Html->link(
                                                '密码修改',
                                                ['plugin' => false, 'controller' => 'Users', 'action' => 'change_password']
                                            );
                                        ?>
                                    </div>

                                </li>
                                <li class="user-footer">
                                    <div class="pull-left">
                                    </div>
                                    <div class="pull-right">
                                        <?php
                                            echo $this->Html->link(
                                                '<i class="fa fa-sign-out"></i> 退出',
                                                ['plugin' => false, 'controller' => 'Users', 'action' => 'logout'],
                                                ['class' => 'btn btn-default btn-flat logout', 'escape' => false]
                                            );
                                        ?>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>

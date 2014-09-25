        <header class="header">
            <?php
                echo $this->Html->link(
                    'LeeAdmin',
                    ['controller' => 'Dashboard', 'action' => 'index', 'prefix' => 'admin'],
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
                        <li>
                        <?php
                            echo $this->Html->link(
                                '<i class="fa fa-plug"></i> 插件管理',
                                ['controller' => 'Plugins', 'action' => 'index'],
                                ['escape' => false]
                            );
                        ?></li>
                        <li class="dropdown user user-menu">
                            <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-user"></i>
                                <span><?php echo $this->Session->read('Auth.User.alias'); ?> <i class="caret"></i></span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="user-header bg-light-blue">
                                    <img src="/img/no_avatar.png" class="img-circle" alt="User Image" />
                                    <p>
                                        <?php echo $this->Session->read('Auth.User.alias'); ?> - <?php echo $this->Session->read('Auth.User.group.name'); ?>
                                        <small><?php echo $this->Session->read('Auth.User.email'); ?></small>
                                    </p>
                                </li>
                                <li class="user-body">
                                    <div class="col-xs-4 text-center">
                                        <a href="#">Followers</a>
                                    </div>
                                    <div class="col-xs-4 text-center">
                                        <a href="#">Sales</a>
                                    </div>
                                    <div class="col-xs-4 text-center">
                                        <a href="#">Friends</a>
                                    </div>
                                </li>
                                <li class="user-footer">
                                    <div class="pull-left">
                                        <a href="#" class="btn btn-default btn-flat">Profile</a>
                                    </div>
                                    <div class="pull-right">
                                        <?php
                                            echo $this->Html->link(
                                                '退出',
                                                ['controller' => 'Users', 'action' => 'logout', 'prefix' => 'admin'],
                                                ['class' => 'btn btn-default btn-flat logout']
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

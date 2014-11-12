<?php if (!empty($sidebarMenus)): ?>
            <aside class="left-side sidebar-offcanvas">
                <section class="sidebar">
                    <div class="sidebar-form">
                        <?php
                            echo $this->Html->link(
                                '<i class="fa fa-dashboard"></i> 控制面板',
                                ['plugin' => false, 'controller' => 'Dashboard', 'action' => 'index'],
                                ['class' => 'btn btn-block btn-social btn-linkedin', 'escape' => false]
                            );
                        ?>
                    </div>
                    <ul class="sidebar-menu">
                    <?php foreach ($sidebarMenus as $menuCode => $menu): ?>
                        <?php if (!$this->Admin->checkMenuAccess($menu)) continue; ?>
                        <?php if (empty($menu['sub_menus']) && !empty($menu['link'])): ?>
                        <li>
                            <?php
                                echo $this->Html->link(
                                    sprintf('<i class="%s"></i> <span>%s</span>', $menu['class'], $menu['name']),
                                    $this->Admin->parseUrl($menu['link'], $menu['param']),
                                    ['escape' => false]
                                );
                            ?>
                        </li>
                        <?php elseif(!empty($menu['sub_menus'])): ?>
                        <li class="treeview<?php echo in_array($menu['id'], $sidebarParentIds) ? ' active' : ''; ?>" data-parent-id="<?php echo $menu['id']; ?>">
                            <?php
                                echo $this->Html->link(
                                    sprintf('<i class="%s"></i> <span>%s</span> <i class="fa fa-angle-left pull-right"></i>', $menu['class'], $menu['name']),
                                    'javascript:;',
                                    ['escape' => false]
                                );
                            ?>
                            <ul class="treeview-menu">
                            <?php foreach ($menu['sub_menus'] as $sub): ?>
                                <?php if (!$this->Admin->checkMenuAccess($sub)) continue; ?>
                                <li>
                                <?php
                                    echo $this->Html->link(
                                        sprintf('<i class="fa fa-angle-double-right"></i> %s', $sub['name']),
                                        $this->Admin->parseUrl($sub['link'], $sub['param']),
                                        ['escape' => false]
                                    );
                                ?>
                                </li>
                            <?php endforeach; ?>
                            </ul>
                        </li>
                        <?php endif; ?>
                    <?php endforeach; ?>
                    </ul>
                </section>
            </aside>
<?php endif; ?>

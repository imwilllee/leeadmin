            <aside class="left-side sidebar-offcanvas">
                <section class="sidebar">
                    <ul class="sidebar-menu">
                    <?php foreach ($sidebarMenus as $menuCode => $menu): ?>
                        <?php if (empty($menu['sub_menus']) && !empty($menu['link'])): ?>
                        <li>
                            <?php
                                echo $this->Html->link(
                                    sprintf('<i class="%s"></i> <span>%s</span>', $menu['class'], $menu['name']),
                                    $this->Admin->parseUrl($menu['link']),
                                    ['escape' => false]
                                );
                            ?>
                        </li>
                        <?php else: ?>
                        <li class="treeview<?php echo in_array($menuCode, $sidebarActiveCodes) ? ' active' : ''; ?>" data-menu-code="<?php echo $menuCode; ?>">
                            <?php
                                echo $this->Html->link(
                                    sprintf('<i class="%s"></i> <span>%s</span> <i class="fa fa-angle-left pull-right"></i>', $menu['class'], $menu['name']),
                                    'javascript:;',
                                    ['escape' => false]
                                );
                            ?>
                            <ul class="treeview-menu">
                            <?php foreach ($menu['sub_menus'] as $sub): ?>
                                <li>
                                <?php
                                    echo $this->Html->link(
                                        sprintf('<i class="fa fa-angle-double-right"></i> %s', $sub['name']),
                                        $this->Admin->parseUrl($sub['link']),
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

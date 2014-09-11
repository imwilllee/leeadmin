            <aside class="right-side">
                <section class="content-header">
                    <h1>
                        <?php echo h($mainTitle); ?>
                        <?php if ($subTitle != ''): ?>
                        <small><?php echo h($subTitle); ?></small>
                        <?php endif; ?>
                    </h1>
<?php if (isset($breadcrumbs)): ?>
                    <ol class="breadcrumb">
                        <li>
                        <?php
                            echo $this->Html->link(
                                '<i class="fa fa-home"></i> LeeAdmin',
                                ['plugin' => false, 'controller' => 'Dashboard', 'action' => 'index', 'prefix' => 'admin'],
                                ['escape' => false]
                            );
                        ?>
                        </li>
                    <?php foreach ($breadcrumbs as $breadcrumb): ?>
                        <?php if (isset($breadcrumb['active'])): ?>
                        <li class="active"><?php echo $breadcrumb['text']; ?></li>
                        <?php else: ?>
                        <li><?php echo $this->Html->link($breadcrumb['text'], $breadcrumb['url'], ['escape' => false]); ?></li>
                        <?php endif; ?>
                    <?php endforeach; ?>
                    </ol>
<?php endif; ?>
                </section>
                <section class="content">
<?php echo $this->fetch('content'); ?>
                </section>
            </aside>

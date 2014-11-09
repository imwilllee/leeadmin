                            <ol class="breadcrumb">
                                <li><?php echo $this->Html->link('<i class="fa fa-1 fa-home"></i> 根目录', ['action' => 'index'], ['escape' => false]); ?></li>
                                <?php
                                    $nav = null;
                                    $length = count($breadcrumbs) - 1;
                                ?>
                                <?php foreach ($breadcrumbs as $key => $breadcrumb): ?>
                                <?php if ($key !== $length): ?>
                                    <?php $nav .= $nav === null ? $breadcrumb : DS . $breadcrumb; ?>
                                    <li><?php echo $this->Html->link($breadcrumb, ['action' => 'index', '?' => ['path' => url_encode($nav)]]); ?></li>
                                <?php else:?>
                                    <li class="active"><?php echo h($breadcrumb); ?></li>
                                <?php endif;?>
                                <?php endforeach; ?>
                            </ol>

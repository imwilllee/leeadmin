                            <ol class="breadcrumb">
                                <li><?php echo $this->Html->link('<i class="fa fa-1 fa-home"></i> 根目录', ['action' => 'index'], ['escape' => false]); ?></li>
                                <?php
                                    $nav = null;
                                    $length = count($breadcrumbs) - 1;
                                ?>
                                <?php foreach ($breadcrumbs as $key => $breadcrumb): ?>
                                <?php if ($key !== $length): ?>
                                    <?php $nav .= $nav === null ? $breadcrumb : '/' . $breadcrumb; ?>
                                    <li><?php echo $this->Html->link(url_decode($breadcrumb), ['action' => 'index', '?' => ['path' => $nav]]); ?></li>
                                <?php else:?>
                                    <li class="active"><?php echo h(url_decode($breadcrumb)); ?></li>
                                <?php endif;?>
                                <?php endforeach; ?>
                            </ol>

            <aside class="right-side">
                <section class="content-header">
                    <h1>
                        <?php echo h($mainTitle); ?>
                        <?php if ($subTitle != ''): ?>
                        <small><?php echo h($subTitle); ?></small>
                        <?php endif; ?>
                    </h1>
                </section>
                <section class="content">
<?php if ($this->Session->check('Flash.flash')) : ?>
                    <div class="row">
                        <div class="col-md-12">
<?php echo $this->Flash->render(); ?>
                        </div>
                    </div>
<?php endif;?>
<?php echo $this->fetch('content'); ?>
                </section>
            </aside>

<?php
    use Cake\Core\Configure;
?>
<section class="content">
    <div class="error-page">
        <h2 class="headline text-info"> <?php echo $code; ?></h2>
        <div class="error-content">
            <h3><i class="fa fa-warning text-yellow"></i> <?php echo h($message); ?></h3>
            <p><?php echo sprintf('很抱歉，您请求的地址“<strong class="text-light-blue">%s</strong>”不存在！', $url); ?></p>
            <?php if ($this->Session->check('Auth.User.id')): ?>
            <?php
                echo $this->Html->link(
                        '返回控制面板',
                        ['plugin' => false, 'controller' => 'dashboard', 'action' => 'index', 'prefix' => 'admin'],
                        ['class' => 'btn btn-primary btn-flat']
                    );
            ?>
            <?php endif; ?>
        </div>
    </div>
<?php
if (Configure::read('debug')):
    echo $this->element('exception_stack_trace');
endif;
?>
</section>

<?php
    $this->append('importCss');
    echo $this->element('Common/Css/common');
    $this->end();
?>
<!DOCTYPE html>
<html>
    <head>
<?php echo $this->element('Common/head'); ?>
    </head>
    <body class="skin-blue">
<?php if ($this->Session->check('Auth.User.id')): ?>
<?php echo $this->element('Common/header'); ?>
        <div class="wrapper row-offcanvas row-offcanvas-left">
<?php echo $this->element('Common/left_side'); ?>
<?php echo $this->element('Common/right_side'); ?>
        </div>
<?php else: ?>
        <div class="right-side strech">
            <?php echo $this->fetch('content'); ?>
        </div>

<?php endif;?>

<?php echo $this->element('Common/Script/common'); ?>
    </body>
</html>
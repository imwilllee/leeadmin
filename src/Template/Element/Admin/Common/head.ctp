    <head>
        <meta charset="UTF-8">
        <title><?php echo $this->Admin->title(); ?></title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <?php
            echo $this->Html->css('bootstrap.min');
            echo $this->fetch('importCss');
            echo $this->Html->css('admin');
        ?>

        <!--[if lt IE 9]>
        <?php
            echo $this->Html->script(['html5shiv', 'respond.min']);
        ?>
        <![endif]-->
<?php echo $this->fetch('pageStyle'); ?>
    </head>

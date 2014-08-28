<?php $this->append('importCss'); ?>
<?php echo $this->element('Common/Css/common'); ?>
<?php $this->end(); ?>
<!DOCTYPE html>
<html>
  <head>
<?php echo $this->element('Common/head'); ?>
  </head>
  <body class="skin-blue">
<?php echo $this->fetch('content'); ?>
<?php echo $this->element('Common/Script/common'); ?>
  </body>
</html>
<?php
$class = 'error';
if (!empty($params['class'])) {
	$class = $params['class'];
}
?>
<div class="alert alert-<?php echo h($class); ?>"><?php echo h($message); ?></div>
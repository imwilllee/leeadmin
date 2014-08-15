<?php
	echo $this->Form->create();
	echo $this->Form->text('username');
	echo $this->Form->password('password');
	echo $this->Form->submit('登录');
	echo $this->Form->end();
?>
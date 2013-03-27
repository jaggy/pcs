<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $title_for_layout; ?>
	</title>
	<?php

		echo $this->Html->css('bootstrap');
		echo $this->Html->meta('icon');
		echo $this->fetch('meta');
		echo $this->fetch('css');
	?>
</head>
<body>
	<div id="container">
			<?php echo $this->Session->flash(); ?>
			<?php echo $this->fetch('content'); ?>
	</div>
</body>
		<?php echo $this->Html->script('jquery.min'); ?>
		<?php echo $this->Html->script('main'); ?>
		<?php echo $this->fetch('script'); ?>
</html>

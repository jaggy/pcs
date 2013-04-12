<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $title_for_layout; ?>
	</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<?php

		echo $this->Html->css(array('bootstrap.min', 'theme'));
		echo $this->Html->script(array('jquery.min', 'bootstrap.min'));
		echo $this->Html->meta('icon');
		echo $this->fetch('meta');
		echo $this->fetch('css');

	?>
</head>
<body>

	<div class="navbar navbar-inverse navbar-fixed-top">
		<div class="navbar-inner">
				<ul class="nav">
					<li class="active"><a href="#">Home</a></li>
					<li><a href="#">About Us</a></li>
					<li><a href="#">Events</a></li>
					<li><a href="#">Committees</a></li>
					<li><a href="#">Contact Us</a></li>
				</ul>
		</div>
	</div>
	<div class="container" style="margin-top: 50px">
				

			<?php echo $this->Session->flash(); ?>
			<?php echo $this->fetch('content'); ?>
	</div>
</body>
		<?php echo $this->Html->script('main'); ?>
		<?php echo $this->fetch('script'); ?>
</html>


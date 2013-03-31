<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $title_for_layout; ?>
	</title>
	<?php

		echo $this->Html->css(array('theme'));
		echo $this->Html->meta('icon');
		echo $this->fetch('meta');
		echo $this->fetch('css');
	?>
</head>
<body>
	<div id="container">

		<div class="default-logo">
			<h1 class="hidden"><a href="/">Philippine College of Surgeons - Metro Manila Chapter</a></h1>
		</div>

		<div class="navigation">
			<ul>
				<li><a href="#">About</a></li>
				<li><a href="#">Events</a></li>
				<li><a href="#">Contact Us</a></li>
				<li><a href="#">Option</a></li>
			</ul>
		</div>

			<?php echo $this->Session->flash(); ?>
			<?php echo $this->fetch('content'); ?>
	</div>
</body>
		<?php echo $this->Html->script('jquery.min'); ?>
		<?php echo $this->Html->script('main'); ?>
		<?php echo $this->fetch('script'); ?>
</html>


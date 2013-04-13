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
					<li class="active"><a href="/">Home</a></li>
					<li><a href="/announcements">Announcements</a></li>
					<li><a href="/events">Events</a></li>
					<?php  if(isset($user_information)):  ?>
					<li><a href="/committee/<?php echo strtolower(str_replace(' ', '_', $user_information['Committee']['name'])) ?>"><?php echo $user_information['Committee']['name'] ?></a></li>
					<li class="dropdown">
						<a href="#"  class="dropdown-toggle" data-toggle="dropdown"><?php echo "{$user_information['first_name']} {$user_information['last_name']}" ?> &#9660;</a>
						<ul class="dropdown-menu">
							<li><?php echo $this->Html->link('Messages', array('controller' => 'messages', 'action' => 'index')) ?></li>
							<li class="divider"></li>
							<li><?php echo $this->Html->link('Settings', array('controller' => 'users', 'action' => 'settings')) ?></li>
							<li><?php echo $this->Html->link('Logout', array('controller' => 'users', 'action' => 'logout')) ?></li>
						</ul>
					</li>
					<?php endif; ?>
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


<?php foreach ($notifications as $notification): ?>
  <li><?php echo $this->Html->link($notification['Notification']['message'], array('controller' => $notification['Notification']['controller'], 'action'=> $notification['Notification']['action'], $notification['Notification']['parameter'])) ?></li>
<?php endforeach ?>
<?php foreach ($messages as $message): ?>
  <li><?php echo "{$message['Sender']['first_name']} {$message['Sender']['last_name']}" ?>: <?php echo $message['Message']['message'] ?></li>
<?php endforeach ?>
<h1><?php echo $announcement['Announcement']['title'] ?></h1>

<?php echo $announcement['Announcement']['content'] ?>

<p>
  <em>Posted <?php echo date('F d, Y', strtotime($announcement['Announcement']['created'])) ?></em>
</p>
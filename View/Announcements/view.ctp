<div class="page-header">
<h1><?php echo $announcement['Announcement']['title'] ?></h1>
</div>

<?php // if($announcement['Announcement']['reuqest_file']) echo $this->From->input('file', array('type' => 'file')) ?>

<div class="well">
  <?php echo Markdown($announcement['Announcement']['content']); ?>
</div>


<p>
  <em>Posted <?php echo date('F d, Y', strtotime($announcement['Announcement']['created'])) ?></em>
</p>
<div class="page-header">
<h1><?php echo $announcement['Announcement']['title'] ?></h1>
</div>


<div class="well">
  <?php echo Markdown($announcement['Announcement']['content']); ?>
</div>
<p>
  <em>Posted <?php echo date('F d, Y', strtotime($announcement['Announcement']['created'])) ?></em>
</p>


<?php if($submitted): ?>
<div class="alert">
  You have already submitted a file. Upload file to overwrite.
</div>
<?php endif; ?>

<?php if($announcement['Announcement']['request_file']): ?>
<?php 

  echo $this->Form->create('Attachment', array('type' => 'file')); 
  echo $this->Form->input('file', array('type' => 'file', 'label' => false)); 
  echo $this->Form->submit('Upload', array('class' => 'btn btn-primary')); 

?>
<?php endif; ?>


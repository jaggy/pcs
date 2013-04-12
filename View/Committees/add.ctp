<?php 
  echo $this->Form->create(array(
    'inputDefaults' => array(
      'div' => false,
      'class' => 'span12' 
    )
  ));
?>

   <?php echo $this->Form->input('name'); ?>  
   <?php echo $this->Form->input('description'); ?>

<?php 
  echo $this->Form->submit('Create Committee', array('class' => 'btn btn-primary'));
?>


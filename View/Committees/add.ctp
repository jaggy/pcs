<?php 
  echo $this->Form->create(array(
    'inputDefaults' => array(
      'div' => false,
      'label' => false
    )
  ));
?>

  <dl>
    <dt>Name</dt>
    <dl><?php echo $this->Form->input('name'); ?></dl
    <dt>Description</dt>
    <dl><?php echo $this->Form->input('description'); ?></dl>
  </dl>

<?php 
  echo $this->Form->end('Create Committee');
?>


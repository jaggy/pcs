<?php echo $this->Form->create('Committee', array('inputDefaults' => array(
  'div' => false
))); ?>
  <?php echo $this->Form->input('committees') ?>
<?php echo $this->Form->submit('Join', array('div' => false)); ?>
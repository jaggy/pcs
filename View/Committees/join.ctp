<?php echo $this->Form->create('CommitteeUser', array('inputDefaults' => array(
  'div' => false
))) ?>
<?php echo $this->Form->input('Committee', array('multiple' => false, 'name' => 'data[CommitteeUser][committee_id]')); ?>
<?php echo $this->Form->submit('Join'); ?>
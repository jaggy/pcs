<?php echo $this->Html->script('committees/load', array('inline' => false)); ?>
<?php echo $this->Form->create('CommitteeUser', array('inputDefaults' => array(
  'div' => false
))) ?>
<?php echo $this->Form->input('Committee', array('multiple' => false, 'name' => 'data[CommitteeUser][committee_id]', 'class' => 'js-fetch')); ?>
<?php echo $this->Form->submit('Join'); ?>

<div class="management">
  <div class="chairman"></div>
  <div class="co-chairman"></div>
  
</div>

<div class="members">
  <h3>Members</h3>
  <ul>
    
  </ul>
</div>

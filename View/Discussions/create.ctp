<?php echo $this->Form->create('Discussion', array('inputDefaults' => array(
  'div' => false
))) ?>

<fieldset>
  
  <p><?php echo $this->Form->input('Discussion.title'); ?></p>
  <p><?php echo $this->Form->input('Discussion.post'); ?></p>

</fieldset>

<?php echo $this->Form->end(__('Create Discussion')); ?>
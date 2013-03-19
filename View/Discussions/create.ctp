<?php echo $this->Form->create('Discussion', array('inputDefaults' => array(
  'div' => false
))) ?>

<fieldset>
  
  <p><?php echo $this->Form->input('title'); ?></p>
  <p><?php echo $this->Form->input('Post.content'); ?></p>

</fieldset>

<?php echo $this->Form->end(__('Create Discussion')); ?>
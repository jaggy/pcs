<?php echo $this->Form->create('Discussion', array('inputDefaults' => array(
  'div' => false,
  'class' => 'span12'
))) ?>

<fieldset>
  
  <p><?php echo $this->Form->input('Discussion.title'); ?></p>
  <p><?php echo $this->Form->input('Post.content'); ?></p>

</fieldset>

<?php echo $this->Form->submit(__('Create Discussion'), array( 'div' => false, 'class' => 'btn btn-primary')); ?>
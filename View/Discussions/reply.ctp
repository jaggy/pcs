<?php echo $this->Form->create('Post', array('inputDefaults' => array('div' => false))); ?>
<?php echo $this->Form->input('Post.content'); ?>
<?php echo $this->Form->end('Reply'); ?>
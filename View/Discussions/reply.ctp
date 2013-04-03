<h1><?php echo $discussion['Discussion']['title'] ?></h1>
<?php echo $this->Editor->nl2p($discussion['Discussion']['post']) ?>

<?php echo $this->Form->create('Post', array('inputDefaults' => array('div' => false))); ?>
<?php echo $this->Form->input('Post.content'); ?>
<?php echo $this->Form->end('Reply'); ?>
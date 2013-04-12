<div class="page-header">
  <h1><?php echo $discussion['Discussion']['title'] ?></h1>
</div>

<div class="hero-unit">
  <?php echo $this->Editor->nl2p($initial_post) ?>
</div>

<?php echo $this->Form->create('Post', array('inputDefaults' => array('div' => false, 'class' => 'span12'))); ?>
<?php echo $this->Form->input('Post.content', array('label' => 'Reply')); ?>
<?php echo $this->Form->submit('Reply', array('class' => 'btn btn-primary')); ?>
<?php echo $this->Form->create('Announcement', array('inputDefaults' => array('div' => false), 'type' => 'file')); ?>
<?php echo $this->Form->submit('Create') ?>

<div>
  <?php echo $this->Form->input('title', array('label' => false, 'autocomplete' => false, 'placeholder' => 'Title')) ?>
</div>
<div>
  <?php echo $this->Form->input('content', array('label' => false, 'placeholder' => "The post's main content!")) ?>
</div>

<fieldset>
  <p><?php echo $this->Form->input('description')  ?></p>
  <p><?php echo $this->Form->input('status', array('checked' => 'checked'))  ?></p>
  <p><?php echo $this->Form->input('image', array('type' => 'file')) ?></p>
  <p><?php echo $this->Form->input('allow_comments')  ?></p>
</fieldset>
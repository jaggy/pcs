<?php echo $this->Form->create('Announcement', array('inputDefaults' => array('div' => false, 'class' => 'span12'), 'type' => 'file')); ?>

<div>
  <?php echo $this->Form->input('title', array('label' => false, 'autocomplete' => false, 'placeholder' => 'Title')) ?>
</div>
<div>
  <?php echo $this->Form->input('content', array('label' => false, 'placeholder' => "The post's main content!")) ?>
</div>

<fieldset>
  <p><?php echo $this->Form->input('description')  ?></p>
  <p><?php echo $this->Form->input('request_file')  ?></p>
</fieldset>
<?php echo $this->Form->submit('Create', array('class' => 'btn btn-primary')) ?>

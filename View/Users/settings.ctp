<?php 
  echo $this->Form->create('User', array(
    'inputDefaults' => array('div' => false),
    'type' => 'file'
  )); 
?>

<fieldset>
  <fieldset>
    <legend><?php echo sprintf("%s %s %s", $user_information['first_name'], $user_information['middle_name'], $user_information['last_name']) ?></legend>
    <p>
      <?php echo $this->Form->input('first_name', array('placeholder' => 'First Name')); ?>
      <?php echo $this->Form->input('middle_name', array('placeholder' => 'Middle Name')); ?>
      <?php echo $this->Form->input('last_name', array('placeholder' => 'Last Name')); ?>
    </p>
  </fieldset>

  <p>
    <?php echo $this->Form->input('description'); ?>
  </p>
</fieldset>

<fieldset>
  <p>
    <?php echo $this->Form->input('username'); ?>
  </p>
  <p>
    <?php echo $this->Form->input('password', array('value' => '', 'required' => false)); ?>
  </p>
  <p>
    <?php echo $this->Form->input('email'); ?>
  </p>
  <p>
    <?php echo $this->Html->image("/profile/{$user['image']}"); ?>
  </p>
  <p>
    <?php echo $this->Form->input('image', array('type' => 'file')); ?>
  </p>
</fieldset>

<?php echo $this->Form->submit('Update', array('div' => false, 'class' => 'btn btn-primary')); ?>
<?php echo $this->Html->link('Delete', array('action' => 'delete'), array('class' => 'btn btn-danger')); ?>
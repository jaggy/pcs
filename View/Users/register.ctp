<div class="register">
  <?php 
    echo $this->Form->create('User', 
        array(
          'action' => 'register',
          'inputDefaults' => array(
            'div' => false,
            'label' => false
          )
        )
    ); 
  ?>
  <ul>
    <li>
      <?php echo $this->Form->input('first_name', array('placeholder' => 'First Name', 'autofocus' => 'autofocus')); ?>
      <?php echo $this->Form->input('last_name', array('placeholder' => 'Last Name')); ?>
    </li>
    <li><?php echo $this->Form->input('username', array('placeholder' => 'Username')); ?></li>
    <li> <?php echo $this->Form->input('email', array('placeholder' => 'Email')); ?> </li>
    <li> <?php echo $this->Form->input('password'); ?></li>
  </ul>
  <?php echo $this->Form->end(__('Register')); ?>
</div>
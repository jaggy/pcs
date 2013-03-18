
<header>
  <div class="wrap">
    <aside class="logo">
      <a href="/">Philippine College of Surgeons</a>
    </aside>    
  </div>
</header>


<?php echo $this->Form->create('User', array('inputDefaults' => array('div' => false))); ?>

<fieldset>
  <p>
    <?php echo $this->Form->input('username', array('placeholder' => 'Username')) ?>
  </p>
  <p>
    <?php echo $this->Form->input('password', array('placeholder' => 'Password')); ?>
  </p>
  <p class="buttons">
    <a href="#">Forgot your password?</a>
    <?php echo $this->Form->submit('Login', array('div' => false)); ?>
  </p>
</fieldset>




<?php  if(!$user_information['Committee']):?>
<div class="hero-unit">
  
  <h1>Join a Committee <small><?php echo $this->Html->link('HERE', array('controller' => 'committees', 'action' =>'join')) ?></small></h1>
  
</div>
<?php endif; ?>
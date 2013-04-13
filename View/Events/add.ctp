<?php echo $this->Html->script('events/form', array('inline' => false)) ?>
<?php echo $this->Form->create('Event', array('inputDefaults' => array('div' => false))) ?>

<p><?php echo $this->Form->input('name', array('class' => 'span12')); ?></p>
<p><?php echo $this->Form->input('location', array('class' => 'span12')); ?></p>
<p><?php echo $this->Form->input('description', array('class' => 'span12')); ?></p>
<p><?php echo $this->Form->input('date'); ?></p>
<p><?php echo $this->Form->input('all_day', array('label' => 'All Day Event', 'class' => 'js-toggle time')); ?></p>
<p class="js-hide time">
  <label for="EventStartTime">Start Time</label><?php echo $this->Form->time('start_time'); ?>
  <label for="EventEndTime">End Time</label> <?php echo $this->Form->time('end_time'); ?>
</p>
<p class="js-hide committee hidden"><?php echo $this->Form->input('committee_id', array('empty' => '-- Select Committee --', 'div' => false)) ?></p>

<?php echo $this->Form->end('Create Event') ?>
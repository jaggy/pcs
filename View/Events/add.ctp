<?php echo $this->Html->script('events/form', array('inline' => false)) ?>
<?php echo $this->Form->create('Event', array('inputDefauts' => array('div' => false))) ?>

<p><?php echo $this->Form->input('name'); ?></p>
<p><?php echo $this->Form->input('location'); ?></p>
<p><?php echo $this->Form->input('description'); ?></p>
<p><label for="EventDate">Date</label><?php echo $this->Form->date('date'); ?></p>
<p><?php echo $this->Form->input('all_day', array('label' => 'All Day Event', 'class' => 'js-toggle time')); ?></p>
<p class="js-hide time">
  <label for="EventStartTime">Start Time</label><?php echo $this->Form->time('start_time'); ?>
  <label for="EventEndTime">End Time</label> <?php echo $this->Form->time('end_time'); ?>
</p>
<p><?php echo $this->Form->input('is_public', array('label' => 'All Committees', 'class' => 'js-toggle committee')) ?></p>
<p class="js-hide committee"><?php echo $this->Form->input('committee_id', array('empty' => '-- Select Committee --', 'div' => false)) ?></p>

<?php echo $this->Form->end('Create Event') ?>
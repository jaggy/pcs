<?php echo $this->Form->create('Event', array('inputDefauts' => array('div' => false))) ?>

<p><?php echo $this->Form->input('name'); ?></p>
<p><?php echo $this->Form->input('location'); ?></p>
<p><?php echo $this->Form->input('description'); ?></p>
<p><label for="EventStartDate">Start Date</label><?php echo $this->Form->date('start_date'); ?></p>
<p><label for="EventEndDate">End Date</label><?php echo $this->Form->date('end_date'); ?></p>
<p><?php echo $this->Form->input('all_day'); ?></p>
<p><label for="EventStartTime">Start Time</label><?php echo $this->Form->time('start_time'); ?></p>
<p><label for="EventEndTime">End Time</label> <?php echo $this->Form->time('end_time'); ?></p>
<p><?php echo $this->Form->input('is_public') ?></p>

<?php echo $this->Form->end('Create Event') ?>
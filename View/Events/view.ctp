<div class="page-header">
  <h2><?php echo $event['Event']['name'] ?></h2>
</div>

<h3>Location: <?php echo $event['Event']['location'] ?></h3>
<h3>Date: <?php echo date('F Y', strtotime($event['Event']['date'])) ?></h3>

<div>
  <h4>Attending <?php echo "({$event['Event']['attending_count']})" ?></h4>
  <ul class="thumbnails">
    <?php foreach ($event['Rsvp'] as $rsvp): ?>
      <?php if($rsvp['response'] === 'Yes'): ?>
        <li class="span1" >
          <a href="#" class="js-tooltip" title="<?php echo "{$rsvp['User']['first_name']} {$rsvp['User']['last_name']}" ?>"><?php echo $this->Html->image("/profile/{$rsvp['User']['image']}", array('height' => '100', 'width' => '100')) ?></a>
        </li>
      <?php endif; ?>
    <?php endforeach ?>
  </ul>
</div>

<div>
  <h4>Maybe <?php echo "({$event['Event']['maybe_count']})" ?></h4>
  <ul class="thumbnails">
    <?php foreach ($event['Rsvp'] as $rsvp): ?>
      <?php if($rsvp['response'] === 'Maybe'): ?>
        <li class="span1" >
          <a href="#" class="js-tooltip" title="<?php echo "{$rsvp['User']['first_name']} {$rsvp['User']['last_name']}" ?>"><?php echo $this->Html->image("/profile/{$rsvp['User']['image']}", array('height' => '100', 'width' => '100')) ?></a>
        </li>
      <?php endif; ?>
    <?php endforeach ?>
  </ul>
</div>

<div>
  <h4>Pending <?php echo "({$event['Event']['pending_count']})" ?></h4>
  <ul class="thumbnails">
    <?php foreach ($event['Rsvp'] as $rsvp): ?>
      <?php if($rsvp['response'] === null): ?>
        <li class="span1" >
          <a href="#" class="js-tooltip" title="<?php echo "{$rsvp['User']['first_name']} {$rsvp['User']['last_name']}" ?>"><?php echo $this->Html->image("/profile/{$rsvp['User']['image']}", array('height' => '100', 'width' => '100')) ?></a>
        </li>
      <?php endif; ?>
    <?php endforeach ?>
  </ul>
</div>

<script>
  $('.js-tooltip').tooltip();
</script>
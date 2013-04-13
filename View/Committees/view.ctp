<div class="page-header">
  <h1>
  <?php echo $committee['Committee']['name'] ?>
  <?php if($pending['CommitteeUser'] && !$pending['CommitteeUser'][0]['approved']): ?>
    <small>MEMBERSHIP PENDING</small>
  <?php else: ?>
    <small><?php echo $committee['Committee']['committee_user_count'] ?> members</small>
  <?php endif;?>
  </h1>
</div>

<div class="span3">
  <div class="chairman">
  <?php if(array_filter($committee['Chairman'])): ?>
      <h3>
        Chairman
      </h3>

      <div style="margin-left: 10px;">
        <div class="box">
          <?php 
            echo $this->Html->link(
              $this->Html->image("/profile/{$committee['Chairman']['image']}", array('alt' => $committee['Chairman']['username'], 'class' => 'profile-picture')),
              array(
                'controller' => 'users',
                'action' => 'profile', 
                $committee['Chairman']['username']
              ),
              array(
                'escape' => false
              )
            ); 
          ?>
        </div>
        <div  class="box right" >
          <strong>
            <?php 
              echo $this->Html->link(
                "{$committee['Chairman']['first_name']} {$committee['Chairman']['middle_name']} {$committee['Chairman']['last_name']}",
                array(
                  'controller' => 'users',
                  'action' => 'profile', 
                  $committee['Chairman']['username']
                )
              ); 
            ?>
          </strong>
          <p><?php echo $committee['Chairman']['description'] ?></p>
        </div>
      </div>
  <?php else: ?>
    <h3><em>There's no committee head yet.</em></h3>
  <?php endif; ?>
</div>
<?php if(array_filter($committee['CoChairman'])): ?>
<div class="co-chairman">
    <h3>
      Co-Chairman
    </h3>
    <div style="margin-left: 10px;">
      <div class="box">
        <?php 
          echo $this->Html->link(
            $this->Html->image("/profile/{$committee['CoChairman']['image']}", array('alt' => $committee['CoChairman']['username'])),
            array(
              'controller' => 'users',
              'action' => 'profile', 
              $committee['CoChairman']['username']
            ),
            array(
              'escape' => false
            )
          ); 
        ?>
      </div>
      <div class="box">
        <strong>
          <?php 
            echo $this->Html->link(
              "{$committee['CoChairman']['first_name']} {$committee['CoChairman']['middle_name']} {$committee['CoChairman']['last_name']}",
              array(
                'controller' => 'users',
                'action' => 'profile', 
                $committee['CoChairman']['username']
              )
            ); 
          ?>
        </strong>
        <p><?php echo $committee['CoChairman']['description'] ?></p>
      </div>
    </div>
</div>
<?php endif; ?>
</div>
<div class="span6">
  
  <div class="description">
    <p><?php echo $committee['Committee']['description'] ?></p>
  </div>

<div class="discussions">
  <h3>Discussions</h3>

  <div>
    <?php echo $this->Html->link('Create Discussion', array('controller' => 'discussions', 'action' => 'create', strtolower(str_replace(' ', '_', $committee['Committee']['name']))), array('class' => 'btn', 'style' => 'margin-bottom: 10px;')); ?>
  </div>

  <ul>

  <?php foreach($committee['Discussion'] as $discussion): ?>
    <li><?php echo $this->Html->link($discussion['title'], array('controller' => 'discussions', 'action' => 'view', $discussion['id'])) ?></li>
  <?php endforeach; ?>

  </ul>
</div>
</div>
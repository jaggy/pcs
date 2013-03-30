<h2><?php echo $committee['Committee']['name'] ?></h2>
<?php if($pending && !$pending['CommitteeUser'][0]['approved']): ?>
  <em>Your membership is yet to be approved</em>
<?php endif;?>

<div class="management">
  <div class="chairman">
    <?php if(array_filter($committee['Chairman'])): ?>
        <h3>
          Chairman
        </h3>
        <?php 
          echo $this->Html->link(
            $this->Html->image("/profile/{$committee['Chairman']['image']}", array('alt' => $committee['Chairman']['username'])),
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
    <?php else: ?>
      <h3><em>There's no committee head yet.</em></h3>
    <?php endif; ?>
  </div>

  <?php if(array_filter($committee['CoChairman'])): ?>
  <div class="co-chairman">
      <h3>
        Co-Chairman
      </h3>
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
  <?php endif; ?>
</div>

<div class="discussions">
  <h3>Discussions</h3>

  <div>
    <?php echo $this->Html->link('Create Discussion', array('controller' => 'discussions', 'action' => 'create', strtolower(str_replace(' ', '_', $committee['Committee']['name'])))); ?>
  </div>

  <ul>

  <?php foreach($committee['Discussion'] as $discussion): ?>
    <li><?php echo $this->Html->link($discussion['title'], array('controller' => 'discussions', 'action' => 'view', $discussion['id'])) ?></li>
  <?php endforeach; ?>

  </ul>
</div>

<div class="members">
  <h3>Members</h3>
  <ul>
    <?php foreach($committee['CommitteeUser'] as $member): ?>
        <li>
          <a href="/profile/<?php echo $member['User']['username'] ?>">
            <div class="member">
              <?php echo $this->Html->image("/profile/{$member['User']['image']}", array('alt' => $member['User']['username'])); ?>
              <strong class="name"> 
                <?php echo "{$member['User']['first_name']} {$member['User']['middle_name']} {$member['User']['last_name']}"; ?>
              </strong>
            </div>
          </a>
        </li>
    <?php endforeach; ?>
  </ul>
</div>


<h2><?php echo $committee['Committee']['name'] ?></h2>
<?php if($pending && !$pending['CommitteeUser']['approved']): ?>
  <em>Your membership is yet to be approved</em>
<?php endif;?>

<div class="head">
  <?php if(array_filter($committee['User'])): ?>
      <h3>
        Committee Head
      </h3>
      <?php 
        echo $this->Html->link(
          $this->Html->image("/profile/{$committee['User']['image']}", array('alt' => $committee['User']['username'])),
          array(
            'controller' => 'users',
            'action' => 'profile', 
            $committee['User']['username']
          ),
          array(
            'escape' => false
          )
        ); 
      ?>
      <strong>
        <?php 
          echo $this->Html->link(
            "{$committee['User']['first_name']} {$committee['User']['middle_name']} {$committee['User']['last_name']}",
            array(
              'controller' => 'users',
              'action' => 'profile', 
              $committee['User']['username']
            )
          ); 
        ?>
      </strong>
      <p><?php echo $committee['User']['description'] ?></p>
  <?php else: ?>
    <h3><em>There's no committee head yet.</em></h3>
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


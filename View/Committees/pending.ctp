<?php foreach($committees as $committee): ?>

  <div class="committee <?= strtolower($committee['Committee']['name'])?>">
    <h2><?= $committee['Committee']['name'] ?></h2>
    <p><?= $committee['Committee']['description'] ?></p>

    <div class="users">
    <?php foreach($committee['CommitteeUser'] as $user): ?>

      <div class="user">
        <?php echo $this->Html->image("/profile/{$user['User']['image']}") ?>
        <h3><?php echo "{$user['User']['first_name']} {$user['User']['middle_name']} {$user['User']['last_name']}" ?></h3>
        <p><?php echo $user['User']['description'] ?></p>

        <div class="actions">
          <?php echo $this->Html->link('Approve', '#', array('class' => 'js-approve')); ?>
          <?php echo $this->Html->link('Dispprove', '#', array('class' => 'js-disapprove')); ?>
        </div>
      </div>

    <?php endforeach; ?>
    </div> 

  </div>

<?php endforeach; ?>

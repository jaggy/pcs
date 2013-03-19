<?php echo $this->Html->script('committees/pending', array('inline' => false)); ?>
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
          <?php echo $this->Html->link('Approve', '#', array('class' => "js-approve ". str_replace(' ', '_', strtolower($committee['Committee']['name'])) ." {$user['User']['username']}" )); ?>
          <?php echo $this->Html->link('Dispprove', '#', array('class' => "js-disapprove ". str_replace(' ', '_', strtolower($committee['Committee']['name'])) ." {$user['User']['username']}")); ?>
        </div>
      </div>
  
    <?php endforeach; ?>
    </div> 

  </div>

<?php endforeach; ?>

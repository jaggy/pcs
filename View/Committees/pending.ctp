<?php echo $this->Html->script('committees/pending', array('inline' => false)); ?>

<div class="page-header">
  <h1>Pending</h1>
</div>

<div class="notice <?php if($committees) echo "hidden"; ?>">
  <strong><em>There are no pending accounts</em></strong>
</div>
<?php foreach($committees as $committee): ?>

  <div class="committee <?= strtolower($committee['Committee']['name'])?> well">
    <h3><?= $committee['Committee']['name'] ?></h3>
    <p><?= $committee['Committee']['description'] ?></p>

    <div class="users">
    <?php foreach($committee['CommitteeUser'] as $user): ?>

      <div class="user media">
        <a href="#" class="pull-left"><?php echo $this->Html->image("/profile/{$user['User']['image']}", array('class' => 'media-object')) ?></a>
        <div class="media-body">
          <h4><?php echo "{$user['User']['first_name']} {$user['User']['middle_name']} {$user['User']['last_name']}" ?></h4>
          <p><?php echo $user['User']['description'] ?></p>

          <div class="actions">
            <?php echo $this->Html->link('Approve', '#', array('class' => "js-decide-approve ". str_replace(' ', '_', strtolower($committee['Committee']['name'])) ." {$user['User']['username']} btn btn-primary" )); ?>
            <?php echo $this->Html->link('Dispprove', '#', array('class' => "js-decide-disapprove ". str_replace(' ', '_', strtolower($committee['Committee']['name'])) ." {$user['User']['username']} btn btn-danger")); ?>
          </div>
        </div>
      </div>
  
    <?php endforeach; ?>
    </div> 

  </div>

<?php endforeach; ?>


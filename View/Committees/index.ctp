<?php echo $this->Html->link('Create a new committee', array('action' => 'add')); ?> 
<ul>
  <?php foreach($committees as $committee): ?>
    <li>
      <a href="/committee/<?= str_replace(' ', '_', strtolower($committee['Committee']['name']))?>">
        <strong><?php echo $committee['Committee']['name'] ?></strong>
        <span>
          <time><?php echo date('jS M, Y', strtotime($committee['Committee']['created'])); ?></time>
        </span>
        <p>
          <?php echo $committee['Committee']['description']; ?>
        </p>
      </a>
    </li>
  <?php endforeach; ?>
</ul>
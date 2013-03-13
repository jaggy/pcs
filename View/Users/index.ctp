<ul>
  <?php foreach($users as $user): ?>
    <li>
      <a href="users/view/<?php echo $user['User']['id'] ?>">
        <strong><?php echo $user['User']['first_name'] ?></strong>
        <span>Username: <?php echo $user['User']['username']; ?></span>
        <em class="highlight"><?php echo $user['Role']['name'] ?></em>
      </a>
    </li>
  <?php endforeach; ?>
</ul>
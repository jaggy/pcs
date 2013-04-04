<ul>
  <li>Title</li>
  <li>Created by</li>
  <li>Last Update</li>
  <li>Last Reply</li>
  <li>Stats</li>
</ul>
<?php foreach($discussions as $discussion): ?>
<div class="discussion">
  <ul>
    <li><?php echo $this->Html->link($discussion['title'], array('action' => 'view', $discussion['id'])) ?></li>
    <li><?php echo $this->Html->link($discussion['User']['username'], array('controller' => 'users', 'action' => 'profile', $discussion['User']['username'])) ?></li>
    <li><?php echo date('d.m.Y @ g:iA', strtotime($discussion['modified'])); ?></li>
    <li><?php echo $this->Html->link($discussion['Post'][0]['User']['username'], array('controller' => 'users', 'action' => 'profile', $discussion['Post'][0]['User']['username'])) ?></li>
    <li>
      <?php echo "Replies: " . ($discussion['post_count'] - 1) ?>
      <br />
      <?php echo "Views: {$discussion['view_count']}" ?>
    </li>
  </ul>
</div>
<?php endforeach; ?>

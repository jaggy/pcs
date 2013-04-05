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
    <li><?php echo $this->Html->link($discussion['Discussion']['title'], array('action' => 'view', $discussion['Discussion']['id'])) ?></li>
    <li><?php echo $this->Html->link($discussion['User']['username'], array('controller' => 'users', 'action' => 'profile', $discussion['User']['username'])) ?></li>
    <li><?php echo date('d.m.Y @ g:iA', strtotime($discussion['Discussion']['last_updated'])); ?></li>
    <li><?php echo $this->Html->link($discussion['Post'][0]['User']['username'], array('controller' => 'users', 'action' => 'profile', $discussion['Post'][0]['User']['username'])) ?></li>
    <li>
      <?php echo "Replies: " . ($discussion['Discussion']['post_count'] - 1) ?>
      <br />
      <?php echo "Views: {$discussion['Discussion']['view_count']}" ?>
    </li>
  </ul>
</div>
<?php endforeach; ?>

<?php if($this->paginator->numbers()): ?>

  <div class="pagination">
    <?php $route = array('url' => array('controller' => 'discussions', 'action' => 'index' )) ; ?>

    <?php  echo $this->paginator->prev('<< Prev', $route); ?>
    &nbsp;
    <?php echo $this->paginator->numbers($route); ?>
    &nbsp;
    <?php echo $this->paginator->next('Next >>', $route); ?>
  </div>
<?php endif; ?> 
<table class="table table-hover">
  <tr>
    <th>Title</th>
    <th>Created by</th>
    <th>Last Updated</th>
    <th>Last Reply</th>
    <th>Stats</th>
  </tr>

  <?php foreach($discussions as $discussion): ?>
  <tr>
    <td><?php echo $this->Html->link($discussion['Discussion']['title'], array('action' => 'view', $discussion['Discussion']['id'])) ?></td>
    <td><?php echo $this->Html->link($discussion['User']['username'], array('controller' => 'users', 'action' => 'profile', $discussion['User']['username'])) ?></td>
    <td><?php echo date('F d, Y @ g:iA', strtotime($discussion['Discussion']['last_updated'])); ?></td>
    <td><?php echo $this->Html->link($discussion['Post'][0]['User']['username'], array('controller' => 'users', 'action' => 'profile', $discussion['Post'][0]['User']['username'])) ?></td>
    <td>
      <?php echo "Replies: " . ($discussion['Discussion']['post_count'] - 1) ?>
      <br />
      <?php echo "Views: {$discussion['Discussion']['view_count']}" ?>
    </td>
  </tr>
  <?php endforeach; ?>
</table>



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
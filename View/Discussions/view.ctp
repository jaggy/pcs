<div class="discussion">
  <h2><?php echo $discussion['Discussion']['title'] ?></h2>
  <div class="details">
    Posted by: <?php echo $this->Html->link("{$discussion['User']['first_name']} {$discussion['User']['last_name']}", array(
      'controller' => 'users',
      'action' => 'profile',
      $discussion['User']['username']
    )) ?>
  </div>
</div>

<div class="posts">

  <?php foreach($posts as $post): ?>
    <div class="post">
      <div class="user">
        <?php echo $this->Html->image("/profile/{$post['User']['image']}") ?>
        <strong><?php echo $this->Html->link("{$post['User']['first_name']} {$post['User']['last_name']}", array('controller' => 'users', 'action' => 'profile', $post['User']['username'] )) ?></strong>
        <em>Member since: <?php echo date('F Y', strtotime($post['User']['created'])) ?></em>
      </div>

      <p><?php echo $post['Post']['content'] ?></p>
    </div>
  <?php endforeach; ?>


  <div class="pagination">
    <?php $route = array('url' => array('controller' => 'discussions', 'action' => 'view', $discussion['Discussion']['id'] )) ; ?>

    <?php  echo $this->paginator->prev('<< Prev', $route); ?>
    &nbsp;
    <?php echo $this->paginator->numbers($route); ?>
    &nbsp;
    <?php echo $this->paginator->next('Next >>', $route); ?>
  </div>
</div>


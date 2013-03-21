<?php echo $this->Html->script('discussions/view', array('inline' => false)); ?>
<div class="discussion">
  <h2><?php echo $discussion['Discussion']['title'] ?></h2>
  <div class="details">
    Posted by: <?php echo $this->Html->link("{$discussion['User']['first_name']} {$discussion['User']['last_name']}", array(
      'controller' => 'users',
      'action' => 'profile',
      $discussion['User']['username']
    )) ?>
  </div>

  <div class="post">
    <p><?php echo $discussion['Discussion']['post'] ?></p>
  </div>
</div>

<div class="actions">
  <?php echo $this->Html->link('Reply', array('controller' => 'discussions', 'action' => 'reply', $discussion['Discussion']['id'])) ?>
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
      Posted on: <?php echo date('F d. Y', strtotime($post['Post']['created'])) ?>

      <div class="actions">
        <a href="#">Report Post</a>
        <a href="#" class="js-reply post-<?= $post['Post']['id']?>">Reply</a>
      </div>

      <div class="reply-box-<?= $post['Post']['id']?> hidden">
        <label for="Reply<?= $post['Post']['id']?>Content">Reply</label>
        <textarea name="data[Reply][content]" id="Reply<?= $post['Post']['id']?>Content" cols="30" rows="10"></textarea>
        <button id="AjaxReply<?= $post['Post']['id']?>">Reply </button>
      </div>
    </div>
  <?php endforeach; ?>


  <?php if($this->paginator->numbers()): ?>

  <div class="pagination">
    <?php $route = array('url' => array('controller' => 'discussions', 'action' => 'view', $discussion['Discussion']['id'] )) ; ?>

    <?php  echo $this->paginator->prev('<< Prev', $route); ?>
    &nbsp;
    <?php echo $this->paginator->numbers($route); ?>
    &nbsp;
    <?php echo $this->paginator->next('Next >>', $route); ?>
  </div>
<?php endif; ?> 
</div>


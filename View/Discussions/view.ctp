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

      <?php echo $this->Editor->nl2p($post['Post']['content']) ?>
      Posted on: <?php echo date('F d. Y', strtotime($post['Post']['created'])) ?>

      <div class="actions">
        <a href="#">Report Post</a>
        <a href="#" class="js-reply-toggle post-<?= $post['Post']['id']?>">Reply</a>
      </div>

      <div class="replies">
        <ul>
          <?php foreach($post['Reply'] as $reply): ?>
              <li> 
                <strong><?php echo $this->Html->link("{$reply['User']['first_name']} {$reply['User']['middle_name']} {$reply['User']['last_name']}", array('controller'=>'users', 'action' => 'profile', $reply['User']['username'])) ?></strong>: 
                <span><?php echo $reply['content'] ?></span>
              </li>
          <?php endforeach; ?>
            <li class="reply-box-<?= $post['Post']['id']?> hidden">
              <label for="Reply<?= $post['Post']['id']?>Content">Reply</label>
              <input type="text" class="js-reply-input-<?= $post['Post']['id']?> post-<?= $post['Post']['id']?>" name="data[Reply][<?= $post['Post']['id']?>][content]" id="Reply<?= $post['Post']['id']?>Content" />
              <button id="AjaxReply<?= $post['Post']['id']?>" class="js-reply-send post-<?= $post['Post']['id']?>">Reply</button>
            </li>
        </ul>
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


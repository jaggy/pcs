<?php echo $this->Html->script('discussions/view', array('inline' => false)); ?>

<div class="page-header">
  <h1><?php echo $discussion['Discussion']['title'] ?></h1>
  <div class="details">
    Posted by: <?php echo $this->Html->link("{$discussion['User']['first_name']} {$discussion['User']['last_name']}", array(
      'controller' => 'users',
      'action' => 'profile',
      $discussion['User']['username']
    )) ?>
  </div>

</div>

<div class="actions" style="text-align: right; margin-bottom: 15px">
  <?php echo $this->Html->link('Reply', array('controller' => 'discussions', 'action' => 'reply', $discussion['Discussion']['id']), array('class' => 'btn btn-primary')) ?>
</div>

<div class="posts">

  <?php foreach($posts as $post): ?>  
    <div class="post well">
      <div class="user box">
        <?php echo $this->Html->image("/profile/{$post['User']['image']}") ?>
        <br>
        <strong><?php echo $this->Html->link("{$post['User']['first_name']} {$post['User']['last_name']}", array('controller' => 'users', 'action' => 'profile', $post['User']['username'] )) ?></strong>
      </div>

      <div class="content box">
        <?php echo $this->Editor->nl2p($post['Post']['content']) ?>
        <small>Posted on: <?php echo date('F d. Y', strtotime($post['Post']['created'])) ?></small>
        <div class="actions">
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
              <input type="text" class="js-reply-input-<?= $post['Post']['id']?> post-<?= $post['Post']['id']?>" name="data[Reply][<?= $post['Post']['id']?>][content]" id="Reply<?= $post['Post']['id']?>Content" />
              <button id="AjaxReply<?= $post['Post']['id']?>" class="js-reply-send post-<?= $post['Post']['id']?>">Reply</button>
            </li>
        </ul>
      </div>

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


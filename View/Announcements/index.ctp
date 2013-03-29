<hgroup>
  <h1>Announcements</h1>
  <nav>
    <a href="<?php echo $this->Html->url(array('action' => 'add')) ?>">Create</a>
  </nav>
</hgroup>

<ul>
  
  <?php foreach($announcements as $announcement):  ?>
    <li>
      <a href="<?php echo $this->Html->url(array('action' => 'edit', $announcement['Announcement']['id'])) ?>">
        <strong><?php echo $announcement['Announcement']['title'] ?></strong>
        <span>
          <time><?php echo date('F d, Y') ?></time>
          <em 
            title="<?php echo ($announcement['Announcement']['status']) ? 'This post is currently published' : 'This post is currently unpublished' ?>" 
            class="status <?php echo ($announcement['Announcement']['status']) ? 'published' : 'unpublished' ?>" >
            <?php echo ($announcement['Announcement']['status']) ? 'published' : 'unpublished' ?>
          </em>
        </span>
        <p><?php echo $announcement['Announcement']['description'] ?></p>
      </a>
    </li>
  <?php endforeach;  ?>

  <aside class="paging">

    <?php echo $this->paginator->first(); ?>
    <?php echo $this->paginator->prev(); ?>
    <?php echo $this->paginator->numbers(); ?>
    <?php echo $this->paginator->next(); ?>
    <?php echo $this->paginator->last(); ?>
  </aside>
</ul>
<div class="page=-header">
  <h1>Announcements</h1>
</div>
<?php echo $this->Html->link('Create', array('action' => 'add'), array('class' => 'btn btn-primary', 'style' => 'margin-bottom: 20px;' )) ?>

<table class="table table-hover">
  <tr>
    <th>#</th>
    <th>Title</th>
    <th>Created</th>
  </tr>
  <?php foreach($announcements as $announcement):  ?>
    <tr>
      <td><?php echo $announcement['Announcement']['id'] ?></td>
      <td><?php echo $this->Html->link($announcement['Announcement']['title'], array('action' => 'view', $announcement['Announcement']['id'])) ?></td>
      <td><?php echo date('F d, Y', strtotime($announcement['Announcement']['created'])) ?></td>
    </tr>
  <?php endforeach;  ?>

  
</table>
<aside class="paging">
  <?php echo $this->paginator->first(); ?>
  <?php echo $this->paginator->prev(); ?>
  <?php echo $this->paginator->numbers(); ?>
  <?php echo $this->paginator->next(); ?>
  <?php echo $this->paginator->last(); ?>
</aside>
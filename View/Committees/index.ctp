<h1>Committees</h1>


<div class="create" style="text-align: right; margin-bottom: 10px">
  <?php echo $this->Html->link('Create Committee', array('action' => 'add'), array('class' => 'btn btn-primary right')); ?> 
  
</div>  

<table class="table table-hover">
  <tr>
    <th>#</th>
    <th>Name</th>
    <th>Members</th>
    <th>Discussions</th>
  </tr>

  <?php foreach($committees as $committee): ?>
    <tr>
      <td><?php echo $committee['Committee']['id'] ?></td>
      <td><?php echo $this->Html->link($committee['Committee']['name'], array('action' => 'view', strtolower(str_replace(' ', '_', $committee['Committee']['name'])))) ?></td>
      <td><?php echo $committee['Committee']['committee_user_count'] ?></td>
      <td><?php echo $committee['Committee']['discussion_count'] ?></td>
      <td>
      </td>
    </tr>
  <?php endforeach; ?>

</table>


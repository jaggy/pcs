<table class="table table-striped table-hover">
  <tr>
    <th>Name</th>
    <th>E-mail</th>
  </tr>
  <?php foreach($users as $user): ?>
    <tr>
      <td><?php echo $this->Html->link(sprintf("%s %s %s", $user['User']['first_name'], $user['User']['middle_name'], $user['User']['last_name']), array('controller' =>'users', 'acton' => 'view')) ?></td>
      <td><?php echo $user['User']['email'] ?></td>
    </tr>
  <?php endforeach; ?>

</table>

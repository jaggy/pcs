<table>
  <tr>
    <th><?php echo $this->paginator->sort('name')?></th>
    <th><?php echo $this->paginator->sort('location')?></th>
    <th><?php echo $this->paginator->sort('date')?></th>
  </tr>
  <?php foreach($events as $event): ?>
    <tr>
      <td><?php echo $event['Event']['name'] ?></td>
      <td><?php echo $event['Event']['location'] ?></td>
      <td><?php echo date('F m, Y', strtotime($event['Event']['date'])) ?></td>
    </tr>
  <?php endforeach; ?>
</table>
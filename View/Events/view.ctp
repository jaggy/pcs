<div class="page-header">
  <h2><?php echo $event['Event']['name'] ?></h2>
</div>

<h3>Location: <?php echo $event['Event']['location'] ?></h3>
<h3>Date: <?php echo date('F Y', strtotime($event['Event']['date'])) ?></h3>


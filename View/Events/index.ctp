<table class="table table-hover">
  <tr>
    <th><?php echo $this->paginator->sort('name')?></th>
    <th><?php echo $this->paginator->sort('location')?></th>
    <th><?php echo $this->paginator->sort('date')?></th>
    <th>RSVP</th>
  </tr>
  <?php foreach($events as $event): ?>
    <tr>
      <td><?php echo $this->Html->link($event['Event']['name'], array('action' => 'view', $event['Event']['id'])) ?></td>
      <td><?php echo $event['Event']['location'] ?></td>
      <td><?php echo date('F m, Y', strtotime($event['Event']['date'])) ?></td>
      <td>
        <div class="btn-group">
          <a class="btn dropdown-toggle js-event-button-<?php echo $event['Event']['id'] ?> <?php echo ($event['Rsvp'][0]['response'] === 'Yes') ? 'btn-primary' : (($event['Rsvp'][0]['response'] === 'No') ? 'btn-danger' : (($event['Rsvp'][0]['response'] === 'Maybe') ? 'btn-warning': '')) ?>" data-toggle="dropdown" href="#">
            <span class="js-response-text-<?php echo $event['Event']['id'] ?>"><?php echo ($event['Rsvp'][0]['response']) ? $event['Rsvp'][0]['response'] : 'Respond'; ?></span>
            <span class="caret"></span>
          </a>
          <ul class="dropdown-menu">
            <li><a href="#" class="js-response-yes-<?php echo $event['Event']['id'] ?>">Yes</a></li>
            <li><a href="#" class="js-response-no-<?php echo $event['Event']['id'] ?>">No</a></li>
            <li><a href="#" class="js-response-maybe-<?php echo $event['Event']['id'] ?>">Maybe</a></li>
            <li><a href="#" class="js-response-cancel-<?php echo $event['Event']['id'] ?>">Cancel</a></li>
          </ul>
        </div>

      </td>
    </tr>
  <?php endforeach; ?>
</table>

<script>
  
  $(function(){});

  $('a[class^="js-response-"]').on('click', function(evt){
    evt.preventDefault();

    var classes = $(this).attr('class').split('-');
    var action = classes[2];
    var event_id = classes[3];
    var data = {
      event_id: event_id,
      action: action
    }

    $.ajax({
      url: '/rsvps/respond.json',
      cache: false,
      type: 'POST',
      data: data,
      success: function(data){

        $('.js-event-button-' + event_id).removeClass('btn-warning').removeClass('btn-primary').removeClass('btn-danger');
        switch(data.response){
          case 'Yes':
            $('.js-event-button-' + event_id).addClass('btn-primary');
          break;
          case 'No':
            $('.js-event-button-' + event_id).addClass('btn-danger');
          break;
          case 'Maybe':
            $('.js-event-button-' + event_id).addClass('btn-warning');
          break;
        }
        $('.js-response-text-' + event_id).text((data.response === null) ? 'Respond' : data.response);
      }
    });


  });

</script>
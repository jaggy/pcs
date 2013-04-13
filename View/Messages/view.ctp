<div class="message-container" style="height: 310px; border: 1px solid #ddd; border-radius: 5px">
  
</div>
<?php echo $this->Form->create('Message') ?>
<?php echo $this->Form->input('message', array('class' => 'span12 js-message', 'rows' => 1, 'style' => 'resize: none')) ?>
<?php echo $this->Form->input('recipient_id', array('type' => 'hidden', 'value' => $recipient['Recipient']['id'], 'class' => 'js-recipient')) ?>
<a href="#" class="btn btn-primary js-send">Send</a>

<script>
  
  $(function(){
    load_messages();
    setInterval(load_messages, 1000);
  });

  function load_messages(){
    var recipient_id = $('.js-recipient').val();
      $.ajax({
        url: '/messages/ajax_list/' + recipient_id,
        type: 'GET',
        cache: false,
        success: function(data){
          $('.message-container').empty().append(data);
        }
      });


  }

  function send_message(){
    $.ajax({
      url: '/messages/send.json',
      type: 'POST',
      data: $('#MessageViewForm').serialize(),
      cache: false,
      success: function(data){

        load_messages();
      }
    });
    $('.js-message').val('');
  }

  $('.js-send').on('click', function(evt){
    evt.preventDefault();
    send_message();
  });

  $('.js-message').on('keyup', function(evt){
    if(evt.which == 13){
      send_message();
    }
  });



</script>
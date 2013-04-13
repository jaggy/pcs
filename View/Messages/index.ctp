<div class="page-header">
  <h1>Messages</h1>  
</div>

<div class="action">
  <a href="#" class="btn btn-primary js-select-user">Send a Message</a>
  <div class="input-prepend hidden js-user-autocomplete-container">
    <span class="add-on">@</span>
    <input type="text" placeholder="username" class="js-user-autocomplete" />
    <ul class="dropdown-menu js-user-list">
      <li>fdas</li>
    </ul>
    
  </div>
</div>
<script>
  
  $(function(){});

  $('.js-select-user').on('click', function(evt){
    evt.preventDefault();

    $(this).hide();
    
    $('.js-user-autocomplete-container').removeClass('hidden');


    $('.js-user-autocomplete').on('keyup', function(evt){
        var keyword = $(this).val();

        if(keyword.length == 3){
          $.ajax({
            url: '/users/ajax_list/'+ keyword,
            type: 'GET',
            success: function(data){
              console.error(data);
              $('.js-user-list').empty().append(data);
              $('.js-user-list').show();
              var list = $('.js-user-list');
              var position = $('.js-user-list').position();
              var left = 82;
              
              $('.js-user-list').css('position', 'absolute');
              $('.js-user-list').css('left', left);
              $('.js-user-list').css('top', 188);
            }
          });
        }
        if(evt.which == 13){
          window.location = '/messages/view/' + keyword
        }
    });
  });

</script>
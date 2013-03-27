$('a[class^="js-decide-"]').on('click', function(evt){
  evt.preventDefault();

  var classes = $(this).attr('class').split(' ');
  var action = last(classes[0].split('-'));
  var committee = classes[1];
  var username = classes[2];
  var data = {
    action: action,
    committee: committee,
    username: username
  };

  var user_container = $(this).parent().parent();
  var committee_container = user_container.parent().parent();

  $.post('/committees/pending.json', data, function(data){
    if(data.response){
      disappear(user_container, function(){

        if(committee_container.find('div.user').length === 0){
          committee_container.fadeOut('slow', function(){this.remove();});
        }

        if($('div.user').length === 0){
          $('div.notice').fadeIn();
        }
      });

    }else{
      // print error message
    }
  });
});

$('a[class^="js-"]').on('click', function(){
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


  if(committee_container.find('div.user').length === 1){
    disappear(committee_container);
  }

  $.post('/committees/pending.json', data, function(data){
    if(data.response){
      disappear(user_container);
      if($('div.committee').length === 0){
        $('div.notice').fadeIn();
      }
    }else{
      // print error message
    }
  });
});


var template = {
  head: '<span><h3>Committee Head</h3><a href=""><img src="" alt="" /><a href="#"><strong></strong></a><p></p></span>',
  members: '<li><a href=""> <div class="member"><img src="" alt="" /><strong class="name"></strong></div></a></li>'
};

function display_data(){
  $('.members ul, div.head').empty();
  var committee = $(".js-fetch option:selected").text();
  var parsed_name = committee.replace(/\ /g, '_').toLowerCase();

  //committee/dermatology.json
  $.ajax({
    type: 'GET',
    url: '/committee/' + parsed_name + '.json',
    cache: false,
    dataType: 'json',
    success: function(data){

      var name = '';
      var users = data.committee.CommitteeUser;
      var user = {};
      var clone = '';

      user = data.committee.User;
      if(user.username === null){
        $('.head').append("<h3><em>There's no committee head yet.</em></h3>");
      }else{
        clone = $(template.head).clone();

        if(user.middle_name){
          name = user.first_name + ' ' + user.middle_name + ' ' + user.last_name;
        }else{
          name = user.first_name + ' ' + user.last_name;
        }

        clone.find('img').attr('src', '/profile/' + user.image).attr('alt', user.username);
        clone.find('a').attr('href', '/profile/' + user.username);
        clone.find('strong').text(name);
        clone.find('p').text(user.description);
        $('div.head').append(clone);
      }


      for(var key in users){
        user = users[key].User;
        clone = $(template.members).clone();

        if(user.middle_name){
          name = user.first_name + ' ' + user.middle_name + ' ' + user.last_name;
        }else{
          name = user.first_name + ' ' + user.last_name;
        }

        clone.find('img').attr('src', '/profile/' + user.image).attr('alt', user.username);
        clone.find('a').attr('href', '/profile/' + user.username);
        clone.find('strong').text(name);
        $('div.members >ul').append(clone);
      }

     

    },
    error: function(data){

    }
  });
}

$(function(){
  display_data();

});

$('.js-fetch').on('change', display_data);
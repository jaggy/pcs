
var template = {
  head: '<span><h3>Committee Head</h3><a href=""><img src="" alt="" /><a href="#"><strong></strong></a><p></p></span>',
  members: '<li><a href=""> <div class="member"><img src="" alt="" /><strong class="name"></strong></div></a></li>'
};

function display_data(){
  $('.members ul, div.management > .chairman, div.management > .co-chairman').empty();
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
      var chairman = {};
      var co_chairman = {};
      var clone = '';

      chairman = data.committee.Chairman;
      co_chairman = data.committee.CoChairman;

      if(chairman.username === null){
        $('.management > .chairman').append("<h3><em>There's still no chairperson appointed.</em></h3>");
      }else{
        clone = $(template.head).clone();

        if(chairman.middle_name){
          name = chairman.first_name + ' ' + chairman.middle_name + ' ' + chairman.last_name;
        }else{
          name = chairman.first_name + ' ' + chairman.last_name;
        }

        clone.find('img').attr('src', '/profile/' + chairman.image).attr('alt', chairman.username);
        clone.find('a').attr('href', '/profile/' + chairman.username);
        clone.find('strong').text(name);
        if(chairman.description) clone.find('p').text(chairman.description);
        $('div.management > .chairman').append(clone);
      }

      if(co_chairman.username === null){
        $('.management > .co-chairman').append("<h3><em>There's still no co-chairperson appointed.</em></h3>");
      }else{
        clone = $(template.head).clone();

        if(co_chairman.middle_name){
          name = co_chairman.first_name + ' ' + co_chairman.middle_name + ' ' + co_chairman.last_name;
        }else{
          name = co_chairman.first_name + ' ' + co_chairman.last_name;
        }

        clone.find('img').attr('src', '/profile/' + co_chairman.image).attr('alt', co_chairman.username);
        clone.find('a').attr('href', '/profile/' + co_chairman.username);
        clone.find('strong').text(name);
        if(co_chairman.description) clone.find('p').text(co_chairman.description);
        $('div.management > .co-chairman').append(clone);
      }


      for(var key in users){
        member = users[key].User;
        clone = $(template.members).clone();

        if(member.middle_name){
          name = member.first_name + ' ' + member.middle_name + ' ' + member.last_name;
        }else{
          name = member.first_name + ' ' + member.last_name;
        }

        clone.find('img').attr('src', '/profile/' + member.image).attr('alt', member.username);
        clone.find('a').attr('href', '/profile/' + member.username);
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
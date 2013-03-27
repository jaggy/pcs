function post_reply(element){

  var classes = $(element).attr('class').split(' ');
  var post_id = last(last(classes).split('-'));
  var self = $(element);

  var data = {
    content: $('input[name="data[Reply][' +post_id+ '][content]"]').val(),
    post_id: post_id
  };

  $.ajax({
    url: '/replies/add.json',
    type: 'POST',
    data: data,
    dataType: 'json',
    cache: false,
    success: function(data){
      var user = data.response.User;
      var reply = data.response.Reply;
      var name = user.first_name + ' ' + user.middle_name + ' ' + user.last_name;
      self.parent().before('<li><strong><a href="/profile/' +user.username+ '">' +name+ '</a></strong>: <span>' + reply.content + '</span></li>');
      self.parent().children('input').val('');
    },
    error: function(data){
      
    }
  }); 
}

$(function(){
});



$('.js-reply-toggle').on('click', function(evt){
  evt.preventDefault();

  var classes = $(this).attr('class').split(' ');
  var post_id = last(last(classes).split('-'));

  $('.reply-box-' + post_id).show();
  $('.reply-box-' + post_id + ' input').focus();



});


$('.js-reply-send').on('click', function(evt){
  evt.preventDefault();

  if($(this).val() !== '') post_reply(this);
});

$('input[class^="js-reply-input-"]').on('keyup', function(evt){
  if(evt.which == 13 && $(this).val() !== "") post_reply(this);
});
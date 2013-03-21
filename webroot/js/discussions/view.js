$(function(){
});

$('.js-reply').on('click', function(evt){
  evt.preventDefault();

  var classes = $(this).attr('class').split(' ');
  var post_id = last(last(classes).split('-'));

  appear($('.reply-box-' + post_id));
});
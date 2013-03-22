$(function(){
});

$('.js-reply-toggle').on('click', function(evt){
  evt.preventDefault();

  var classes = $(this).attr('class').split(' ');
  var post_id = last(last(classes).split('-'));

  appear($('.reply-box-' + post_id));

});


$('.js-reply-send').on('click', function(evt){
  evt.preventDefault();

  var classes = $(this).attr('class').split(' ');
  var post_id = last(last(classes).split('-'));

  var data = {
    content: $('textarea[name="data[Reply][' +post_id+ '][content]"]').val(),
    post_id: post_id
  };

  $.ajax({
    url: '/replies/add.json',
    type: 'POST',
    data: data,
    dataType: 'json',
    cache: false,
    success: function(data){
      console.error(data);
    },
    error: function(data){}
  });

});
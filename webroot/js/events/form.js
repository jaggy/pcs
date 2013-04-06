$(function(){

});

$('.js-toggle').on('click', function(evt){

  var target = $(this).attr('class').split(' ')[1];
  $('.js-hide.' + target).toggleClass('hidden');

});
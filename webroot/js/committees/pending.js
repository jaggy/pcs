// $('.add-fav').click(function() {
//     var id = $(this).attr('id');
//     $.post('/ajax/addFavorite',{id:id}, function(data){
//    console.log(data);
//     }, 'json');
// });



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

  var container = $(this).parent().parent();
  container.animate({ height: 0, opacity: 0 }, 'slow');

  $.post('/committees/pending.json', data, function(data){
    console.error(data);
    $('body').append(data);
  });
});

function last(array){
  return array[array.length-1];
}

function appear(container){
  container.css('opacity', 0).slideDown('slow').animate(
    { opacity: 1 },
    { queue: false, duration: 'slow' }
  );
}

function disappear(container, callback){
  container.animate({ height: 0, opacity: 0 }, 'slow', function(){
    this.remove();

    if(callback !== undefined) setTimeout(callback, 500);
  });
}
function last(array){
  return array[array.length-1];
}

function appear(contaner){
  container.slideDown();
}

function disappear(container, callback){
  container.animate({ height: 0, opacity: 0 }, 'slow', function(){
    this.remove();

    if(callback !== undefined) setTimeout(callback, 500);
  });
}
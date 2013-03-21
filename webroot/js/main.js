function last(array){
  return array[array.length-1];
}

function appear(){

}

function disappear(container){
  container.animate({ height: 0, opacity: 0 }, 'slow', function(){
    this.remove();

  });
}
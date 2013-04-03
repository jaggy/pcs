<?php

App::uses('AppHelper', 'Helper');
class EditorHelper extends AppHelper {

  public function nl2p($text){
    $paragraphs = explode("\n", $text);

    foreach($paragraphs as $key => $paragraph){
      if(trim($paragraph) === '') unset($paragraphs[$key]);
    }

    return '<p>'. implode('</p><p>', $paragraphs) .'</p>';
  }
    

}
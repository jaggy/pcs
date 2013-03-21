<?php

App::uses('AppModel', 'Model');
class Reply extends AppModel {

    
    public $belongsTo = array(
      'Post' => array(
        'className' => 'Post',
        'foreignKey' => 'post_id'
      )
    );

}
<?php

App::uses('AppModel', 'Model');
class Post extends AppModel {


  
  public $belongsTo = array(
    'Discussion' => array(
      'className' => 'Discussion',
      'foreignKey' => 'discussion_id'
    ),
    'User' => array(
      'className' => 'User',
      'foreignKey' => 'user_id'
    ),
    'Post' => array(
      'className' => 'Post',
      'foreignKey' => 'post_id'
    )
  );

}
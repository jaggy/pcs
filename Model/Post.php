<?php

App::uses('AppModel', 'Model');
class Post extends AppModel {

  public $hasMany = array(
    'Reply' => array(
      'className' => 'Reply',
      'foreignKey' => 'post_id',
      'dependent' => false
    )
  );
  
  public $belongsTo = array(
    'Discussion' => array(
      'className' => 'Discussion',
      'foreignKey' => 'discussion_id'
    ),
    'User' => array(
      'className' => 'User',
      'foreignKey' => 'user_id'
    )
  );

}
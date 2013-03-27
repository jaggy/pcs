<?php

App::uses('AppModel', 'Model');
class Reply extends AppModel {

  public $validate = array(
    'content' => array(
      'maxLength'   => array(
        'rule'    => array('maxLength', 255),
        'message' => 'content cannot exceed 255 characters',
        //'allowEmpty' => false,
        //'required'   => false,
        //'last'       => false, // Stop validation after this rule
        //'on'         => 'create' // Limit validation to 'create' or 'update' operations
      ),
    )
  );  

    
  public $belongsTo = array(
    'Post' => array(
      'className' => 'Post',
      'foreignKey' => 'post_id'
    ),
    'User' => array(
      'className' => 'User',
      'foreignKey' => 'user_id'
    ),
  );

}
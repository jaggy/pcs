<?php

App::uses('AppModel', 'Model');
class Announcement extends AppModel {

  public $validate = array(
    'title' => array(
      'notEmpty'   => array(
        'rule'    => array('notEmpty'),
        'message' => 'title cannot be empty',
        //'allowEmpty' => false,
        //'required'   => false,
        //'last'       => false, // Stop validation after this rule
        //'on'         => 'create' // Limit validation to 'create' or 'update' operations
      ),
    ),
    'content' => array(
      'notEmpty'   => array(
        'rule'    => array('notEmpty'),
        'message' => 'content cannot be empty',
        //'allowEmpty' => false,
        //'required'   => false,
        //'last'       => false, // Stop validation after this rule
        //'on'         => 'create' // Limit validation to 'create' or 'update' operations
      ),
    )
  );

  public $belongsTo = array(
    'User' => array(
      'className' => 'User',
      'foreignKey' => 'user_id'
    )
  );
      

}
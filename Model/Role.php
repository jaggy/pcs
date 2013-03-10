<?php

App::uses('AppModel', 'Model');
class Role extends AppModel {

  public $validate = array(
    'role' => array(
      'notempty'   => array(
        'rule'    => array('notempty'),
        'message' => 'role cannot be empty',
        //'allowEmpty' => false,
        //'required'   => false,
        //'last'       => fa;se, // Stop validation after this rule
        //'on'         => 'create' // Limit validation to 'create' or 'update' operations
      ),
    )
  );

  public $hasMany = array(
    'User' => array(
      'className' => 'User',
      'foreignKey' => 'role_id',
      'dependent' => false
    )
  );     

}
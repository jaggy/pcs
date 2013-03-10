<?php

App::uses('AppModel', 'Model');
class Role extends AppModel {

  public $hasMany = array(
    'User' => array(
      'className' => 'User',
      'foreignKey' => 'role_id',
      'dependent' => false
    )
  );     

}
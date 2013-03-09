<?php

App::uses('AppModel', 'Model');
class User extends AppModel {

  public $belongsTo = array(
    'Role' => array(
      'className' => 'Role',
      'foreignKey' => 'role_id'
    )
  );

}
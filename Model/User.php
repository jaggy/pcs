<?php

App::uses('AppModel', 'Model');
class User extends AppModel {


  public function beforeSave($options = array()){
    parent::beforeSave($options);

    if(!isset($this->data['User']['role_id'])){
      $this->Role->Behaviors->attach('Containable');
      $role = $this->Role->find('first', array(
        'fields' => array('id'),
        'conditions' => array(
          'name' => 'Member'
        ),
        'contain' => false
      ));

      $this->data['User']['role_id'] = $role['Role']['id'];
    }  

    return true;

  }

  public $belongsTo = array(
    'Role' => array(
      'className' => 'Role',
      'foreignKey' => 'role_id'
    )
  );

}
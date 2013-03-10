<?php

App::uses('AppModel', 'Model');
App::uses('AuthComponent', 'Controller/Component');
class User extends AppModel {


  /**
   * Add the default membership status if it is not existing
   * @return void
   * 
   */
  private function membership(){
    if(!isset($this->data['User']['role_id'])) {
      $this->Role->Behaviors->attach('Containable');

      $role = $this->Role->find('first', array(
        'fields' => array('id'),
        'conditions' => array(
          'name' => 'Member'
        ),
        'contain' => false
      ));

      // set the the role as the regular member
      $this->data['User']['role_id'] = $role['Role']['id'];
    }
  }


  public function hash_password(){
    $this->data['User']['password'] = AuthComponent::password($this->data['User']['password']);
  }

  public function beforeSave($options = array()){
    parent::beforeSave($options);

    $this->membership();
    $this->hash_password();

    return true;

  }

  public $belongsTo = array(
    'Role' => array(
      'className' => 'Role',
      'foreignKey' => 'role_id'
    )
  );

}
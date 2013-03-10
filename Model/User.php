<?php

App::uses('AppModel', 'Model');
App::uses('AuthComponent', 'Controller/Component');
class User extends AppModel {

  public $validate = array(
    'first_name' => array(
      'notempty'   => array(
        'rule'    => array('notempty'),
        'message' => 'first name cannot be empty',
        //'allowEmpty' => false,
        //'required'   => false,
        //'last'       => fa;se, // Stop validation after this rule
        //'on'         => 'create' // Limit validation to 'create' or 'update' operations
      ),
    ),
    'last_name' => array(
      'notempty'   => array(
        'rule'    => array('notempty'),
        'message' => 'last name cannot be empty',
        //'allowEmpty' => false,
        //'required'   => false,
        //'last'       => fa;se, // Stop validation after this rule
        //'on'         => 'create' // Limit validation to 'create' or 'update' operations
      ),
    ),
    'username' => array(
      'isUnique'   => array(
        'rule'    => array('isUnique'),
        'message' => 'username already taken',
        //'allowEmpty' => false,
        //'required'   => false,
        //'last'       => fa;se, // Stop validation after this rule
        //'on'         => 'create' // Limit validation to 'create' or 'update' operations
      ),
      'notempty'   => array(
        'rule'    => array('notempty'),
        'message' => 'username cannot be blank',
        //'allowEmpty' => false,
        //'required'   => false,
        //'last'       => fa;se, // Stop validation after this rule
        //'on'         => 'create' // Limit validation to 'create' or 'update' operations
      ),
      'between'   => array(
        'rule'    => array('between', 5, 18),
        'message' => 'username must be between 5 and 18 characters',
        //'allowEmpty' => false,
        //'required'   => false,
        //'last'       => fa;se, // Stop validation after this rule
        //'on'         => 'create' // Limit validation to 'create' or 'update' operations
      ),
    ),
    'password' => array(
      'notempty'   => array(
        'rule'    => array('notempty'),
        'message' => 'password cannot be empty',
        //'allowEmpty' => false,
        //'required'   => false,
        //'last'       => fa;se, // Stop validation after this rule
        //'on'         => 'create' // Limit validation to 'create' or 'update' operations
      ),
      'minLength'   => array(
        'rule'    => array('minLength', 6),
        'message' => 'password cannot be less than 6 characters',
        //'allowEmpty' => false,
        //'required'   => false,
        //'last'       => fa;se, // Stop validation after this rule
        //'on'         => 'create' // Limit validation to 'create' or 'update' operations
      ),
    ),
    'email' => array(
      'email'   => array(
        'rule'    => array('email'),
        'message' => 'email not valid',
        //'allowEmpty' => false,
        //'required'   => false,
        //'last'       => fa;se, // Stop validation after this rule
        //'on'         => 'create' // Limit validation to 'create' or 'update' operations
      ),
    )
  );


  /**
   * Add the default membership status if it is not existing
   * @return void
   * 
   */
  private function validateMembership(){
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


  /**
   * Hashes the password using CakePHP's Auth Component
   * @return void
   * 
   */
  public function hashPassword(){
    if(!isset($this->data['User']['id'])){
      $this->data['User']['password'] = AuthComponent::password($this->data['User']['password']);
    }
  }

  public function beforeSave($options = array()){
    parent::beforeSave($options);

    $this->validateMembership();
    $this->hashPassword();

    return true;

  }

  public $belongsTo = array(
    'Role' => array(
      'className' => 'Role',
      'foreignKey' => 'role_id'
    )
  );

}
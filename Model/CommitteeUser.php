<?php

App::uses('AppModel', 'Model');
class CommitteeUser extends AppModel {

  public $useTable = 'committees_users';

  public $validate = array(
    'committee_id' => array(
      'isRegistered'   => array(
        'rule'    => array('isRegistered'),
        'message' => 'You already signed up for this committee',
        //'allowEmpty' => false,
        //'required'   => false,
        //'last'       => false, // Stop validation after this rule
        //'on'         => 'create' // Limit validation to 'create' or 'update' operations
      ),
      'standardAccount'   => array(
        'rule'    => array('standardAccount'),
        'message' => 'You cannot join mutliple committees',
        //'allowEmpty' => false,
        //'required'   => false,
        //'last'       => false, // Stop validation after this rule
        //'on'         => 'create' // Limit validation to 'create' or 'update' operations
      ),
    )
  );

  public function isRegistered(){
    $isRegistered = $this->find('count', array(
      'conditions' => array(
        'CommitteeUser.user_id' => $this->data['CommitteeUser']['user_id'],
        'CommitteeUser.committee_id' => $this->data['CommitteeUser']['committee_id']
      )
    ));

    return (!$isRegistered) ? true : false;
  }

  public function standardAccount($conditions){
    $this->User->Behaviors->attach('Containable');
    $user = $this->User->find('first', array(
      'fields' => array('id'),
      'conditions' => array(
        'User.id' => $this->data['CommitteeUser']['user_id']
      ),
      'contain' => array('Role.name', 'CommitteeUser.id')
    ));

    if(count($user['CommitteeUser']) > 0 && $user['Role']['name'] === 'Member'){
      return false;
    }

    return true;
  }

  public $belongsTo = array(
    'User' => array(
      'className' => 'User',
      'foreignKey' => 'user_id'
    ),
    'Committee' => array(
      'className' => 'Committee',
      'foreignKey' => 'committee_id'
    )
  ); 

}
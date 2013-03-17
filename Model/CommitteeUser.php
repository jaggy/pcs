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

  /**
   * Verify if the user is already registered to the selected committee
   * @return boolean
   * 
   */
  public function isRegistered(){
    $isRegistered = $this->find('count', array(
      'conditions' => array(
        'CommitteeUser.user_id' => $this->data['CommitteeUser']['user_id'],
        'CommitteeUser.committee_id' => $this->data['CommitteeUser']['committee_id']
      )
    ));

    return (!$isRegistered) ? true : false;
  }


  /**
   * Check if the user has authorization to join more than 1 committee
   * @return boolean
   * 
   */
  public function standardAccount(){
    $this->User->Behaviors->attach('Containable');
    $user = $this->User->find('first', array(
      'fields' => array('id', 'committee_user_count'),
      'conditions' => array(
        'User.id' => $this->data['CommitteeUser']['user_id']
      ),
      'contain' => array('Role.name')
    ));

    if($user['User']['committee_user_count'] > 0 && $user['Role']['name'] === 'Member'){
      return false;
    }

    return true;
  }

  public $belongsTo = array(
    'User' => array(
      'className' => 'User',
      'foreignKey' => 'user_id',
      'counterCache' => true
    ),
    'Committee' => array(
      'className' => 'Committee',
      'foreignKey' => 'committee_id'
    )
  ); 

}
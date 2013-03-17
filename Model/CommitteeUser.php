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
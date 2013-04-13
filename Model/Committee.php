<?php

App::uses('AppModel', 'Model');
class Committee extends AppModel {

  public $hasMany = array(
    'CommitteeUser' => array(
      'className' => 'CommitteeUser',
      'foreignKey' => 'committee_id',
      'dependent' => false
    ),
    'Discussion' => array(
      'className' => 'Discussion',
      'foreignKey' => 'committee_id',
      'dependent' => false
    ),
    'Event' => array(
      'className' => 'Event',
      'foreignKey' => 'committee_id',
      'dependent' => false
    ),
  );

  public $belongsTo = array(
    'Chairman' => array(
      'className' => 'User',
      'foreignKey' => 'chairman_id'
    ),
    'CoChairman' => array(
      'className' => 'User',
      'foreignKey' => 'co-chairman_id'
    )
  );

  public function available(){
    $this->Behaviors->attach('Containable');
    App::uses('CakeSession', 'Model/Database');

    $committees = array();
    $results = $this->find('all', array(
      'contain' => array(
        'CommitteeUser' => array(
          'conditions' => array(
            'CommitteeUser.user_id' => CakeSession::read('Auth.User.id')
          )
        )
      )
    ));


    foreach($results as $result){
      if(!$result['CommitteeUser']) $committees[$result['Committee']['id']] = $result['Committee']['name']; 
    }

    return $committees;
  }

}
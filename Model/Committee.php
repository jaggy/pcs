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
  );

  public $belongsTo = array(
    'User' => array(
      'className' => 'User',
      'foreignKey' => 'user_id'
    )
  );

}
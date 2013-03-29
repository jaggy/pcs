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
    'Chairman' => array(
      'className' => 'User',
      'foreignKey' => 'chairman_id'
    ),
    'CoChairman' => array(
      'className' => 'User',
      'foreignKey' => 'co-chairman_id'
    )
  );

}
<?php

App::uses('AppModel', 'Model');
class Committee extends AppModel {

  public $hasMany = array(
    'CommitteeUser' => array(
      'className' => 'CommitteeUser',
      'foreignKey' => 'committee_id',
      'dependent' => false
    )
  );

}
<?php

App::uses('AppModel', 'Model');
class CommitteeUser extends AppModel {

  public $useTable = 'committees_users';


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
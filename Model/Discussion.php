<?php

App::uses('AppModel', 'Model');
class Discussion extends AppModel {

  public $belongsTo = array(
    'Committee' => array(
      'className' => 'Committee',
      'foreignKey' => 'committee_id'
    ),
    'User' => array(
      'className' => 'User',
      'foreignKey' => 'user_id'
    )
  );

}
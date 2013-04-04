<?php

App::uses('AppModel', 'Model');
class Discussion extends AppModel {

  public $belongsTo = array(
    'Committee' => array(
      'className' => 'Committee',
      'foreignKey' => 'committee_id',
      'counterCache' => true
    ),
    'User' => array(
      'className' => 'User',
      'foreignKey' => 'user_id'
    )
  );

  public $hasMany = array(
    'Post' => array(
      'className' => 'Post',
      'foreignKey' => 'discussion_id',
      'dependent' => false
    )
  );

}
<?php

App::uses('AppModel', 'Model');
class Event extends AppModel {

  public $validate = array(
    'name' => array(
      'notempty'   => array(
        'rule'    => array('notempty'),
        'message' => 'name cannot be empty',
        //'allowEmpty' => false,
        //'required'   => false,
        //'last'       => false, // Stop validation after this rule
        //'on'         => 'create' // Limit validation to 'create' or 'update' operations
      ),
    )
  );

    public $belongsTo = array(
      'User' => array(
        'className' => 'User',
        'foreignKey' => 'user_id'
      ),
      'Committee' => array(
        'className' => 'Committee',
        'foreignKey' => 'committee_id'
      ),
    );

    public $hasMany = array(
      'Rsvp' => array(
        'className' => 'Rsvp',
        'foreignKey' => 'event_id',
        'dependent' => false
      )
    );

}
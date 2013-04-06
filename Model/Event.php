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
    ),
    'location' => array(
      'notempty'   => array(
        'rule'    => array('notempty'),
        'message' => 'location cannot be empty',
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

}
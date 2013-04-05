<?php

App::uses('AppModel', 'Model');
class Event extends AppModel {

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
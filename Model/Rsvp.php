<?php

App::uses('AppModel', 'Model');
class Rsvp extends AppModel {

    public $belongsTo = array(
      'Event' => array(
        'className' => 'Event',
        'foreignKey' => 'event_id'
      ),
      'User' => array(
        'className' => 'User',
        'foreignKey' => 'user_id'
      )
    );

}
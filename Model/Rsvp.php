<?php

App::uses('AppModel', 'Model');
class Rsvp extends AppModel {

    public $belongsTo = array(
      'Event' => array(
        'className' => 'Event',
        'foreignKey' => 'event_id',
        'counterCache' => array(
          'attending_count' => array('Rsvp.response' => 'Yes'),
          'not_attending_count' => array('Rsvp.response' => 'No'),
          'maybe_count' => array('Rsvp.response' => 'Maybe'),
          'pending_count' => array('Rsvp.response' => null),
        )
      ),
      'User' => array(
        'className' => 'User',
        'foreignKey' => 'user_id'
      )
    );

}
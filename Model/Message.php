<?php

App::uses('AppModel', 'Model');
class Message extends AppModel {

    public $belongsTo = array(
      'Sender' => array(
        'className' => 'User',
        'foreignKey' => 'sender_id'
      ),
      'Recipient' => array(
        'className' => 'User',
        'foreignKey' => 'recipient_id'
      )
    );

}
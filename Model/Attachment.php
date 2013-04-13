<?php

App::uses('AppModel', 'Model');
class Attachment extends AppModel {

    public $belongsTo = array(
      'Announcement' => array(
        'className' => 'Announcement',
        'foreignKey' => 'announcement_id'
      ),
      'User' => array(
        'className' => 'User',
        'foreignKey' => 'user_id'
      )
    );

}
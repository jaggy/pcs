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

    public function afterSave($created){
      parent::afterSave($created);
    
      $this->User->Behaviors->attach('Containable');
  
      App::uses('Notification', 'Model');
      $Notification = new Notification();

      $users = $this->User->find('all', array(
        'fields' => array('id'),
        'contain' => false
      ));

      foreach($users as $user){
        $data[] = array(
          'message' => 'New Event "' . $this->data['Event']['name'] . '"',
          'controller' => 'events',
          'action' => 'view',
          'parameter' => $this->data['Event']['id'],
          'user_id' => $user['User']['id']
        );
      }

      $Notification->saveAll($data);
    }

}
<?php

App::uses('AppModel', 'Model');
class Post extends AppModel {

  public $hasMany = array(
    'Reply' => array(
      'className' => 'Reply',
      'foreignKey' => 'post_id',
      'dependent' => false
    )
  );
  
  public $belongsTo = array(
    'Discussion' => array(
      'className' => 'Discussion',
      'foreignKey' => 'discussion_id',
      'counterCache' => true
    ),
    'User' => array(
      'className' => 'User',
      'foreignKey' => 'user_id',
      'counterCache' => true
    )
  );

  public function afterSave($created){
    parent::afterSave($created);
    $this->User->Behaviors->attach('Containable');
    $this->User->CommitteeUser->Behaviors->attach('Containable');
  
    App::uses('Notification', 'Model');
    $Notification = new Notification();

    $discussion = $this->Discussion->find('first', array(
      'conditions' => array(
        'Discussion.id' => $this->data['Post']['discussion_id']
      ),
      'contain' => 'Committee',
    ));

    $committees = $this->User->CommitteeUser->find('all', array(
      'conditions' => array(
        'CommitteeUser.committee_id' => $discussion['Committee']['id']
      ),
      'fields' => array('id'),
      'contain' => array(
        'User' => array(
          'fields' => array('id')
        )
      )
    ));
    foreach($committees as $committee){
      $data[] = array(
        'message' => 'Reply at Discussion "' . $this->data['Post']['discussion_id'] . '"',
        'controller' => 'discussions',
        'action' => 'view',
        'parameter' => $this->data['Post']['discussion_id'],
        'user_id' => $committee['User']['id']
      );
    }

    $Notification->saveAll($data);
    
  }

}
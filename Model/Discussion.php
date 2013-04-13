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

  public function afterSave($created){
    parent::afterSave($created);

    if(!array_key_exists('view_count', $this->data['Discussion'])){
      $this->User->Behaviors->attach('Containable');
      $this->User->CommitteeUser->Behaviors->attach('Containable');
    
      App::uses('Notification', 'Model');
      $Notification = new Notification();

      $committees = $this->User->CommitteeUser->find('all', array(
        'conditions' => array(
          'CommitteeUser.committee_id' => $this->data['Discussion']['committee_id']
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
          'message' => 'New Discussion "' . $this->data['Discussion']['id'] . '"',
          'controller' => 'discussions',
          'action' => 'view',
          'parameter' => $this->data['Discussion']['id'],
          'user_id' => $committee['User']['id']
        );
      }

      $Notification->saveAll($data);
    }
    
  }

}
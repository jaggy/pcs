<?php

App::uses('AppModel', 'Model');
class Announcement extends AppModel {

  public $validate = array(
    'title' => array(
      'notEmpty'   => array(
        'rule'    => array('notEmpty'),
        'message' => 'title cannot be empty',
        //'allowEmpty' => false,
        //'required'   => false,
        //'last'       => false, // Stop validation after this rule
        //'on'         => 'create' // Limit validation to 'create' or 'update' operations
      ),
    ),
    'content' => array(
      'notEmpty'   => array(
        'rule'    => array('notEmpty'),
        'message' => 'content cannot be empty',
        //'allowEmpty' => false,
        //'required'   => false,
        //'last'       => false, // Stop validation after this rule
        //'on'         => 'create' // Limit validation to 'create' or 'update' operations
      ),
    )
  );

  public $hasMany = array(
    'Attachment' => array(
      'className' => 'Attachment',
      'foreignKey' => 'announcement_id',
      'dependent' => false
    )
  );

  public $belongsTo = array(
    'User' => array(
      'className' => 'User',
      'foreignKey' => 'user_id'
    )
  );

  public function saveImage(){

    if(!empty($this->data['Announcement']['image']['name'])){

      $upload = $this->data['Announcement']['image'];

      if($this->id) $this->read();

      $basename = $upload['name'];

      $tmp = $upload['tmp_name'];
      $extension = pathinfo($basename, PATHINFO_EXTENSION);

      $filename = ($this->id) ? reset(explode('.', $this->data['Announcement']['image'])) . ".{$extension}" : String::uuid() . ".{$extension}";
      $destination = Configure::read('Data.post_images') . $filename;

      $this->data['Announcement']['image'] = $filename;
      
      if(!move_uploaded_file($tmp, $destination)){
        return false;
      }

    }

  }      


  public function beforeSave($options = array()){
    parent::beforeSave($options);
  
    $this->saveImage();
    return true;
  }

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
        'message' => 'New Annoncement "' . $this->data['Announcement']['title'] . '"',
        'controller' => 'announcements',
        'action' => 'view',
        'parameter' => $this->data['Announcement']['id'],
        'user_id' => $user['User']['id']
      );
    }

    $Notification->saveAll($data);

  }

}
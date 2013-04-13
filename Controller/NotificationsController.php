<?php

App::uses('AppController', 'Controller');
class NotificationsController extends AppController{
  
  
  public function ajax_list(){
    $this->layout = 'ajax';
    $notifications = $this->Notification->find('all', array(
      'conditions' => array(
        'user_id' => $this->Session->read('Auth.User.id')
      ),
      'order' => array(
        'created' => 'DESC'
      ),
      'limit' => 5
    ));
    $notifications = array_reverse($notifications);
    $this->set(compact('notifications'));
  }  

}

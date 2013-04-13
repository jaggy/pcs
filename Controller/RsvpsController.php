<?php

App::uses('AppController', 'Controller');
class RsvpsController extends AppController{

  public function respond(){

    if($this->request->is('ajax') && $this->request->is('post')){
      $this->Rsvp->Behaviors->attach('Containable');

      $invite = $this->Rsvp->find('first', array(
        'conditions' => array(
          'user_id' => $this->Session->read('Auth.User.id'),
          'event_id' => $this->request->data['event_id']
        ),
        'contain' => false
      ));



      $response = ($this->request->data['action'] === 'cancel') ? NULL : ucfirst($this->request->data['action']);

      $this->Rsvp->id = $invite['Rsvp']['id'];
      $this->Rsvp->saveField('response', $response);

      $this->set('response', $response);
      $this->set('_serialize', array('response'));
    }

  }  
    

}

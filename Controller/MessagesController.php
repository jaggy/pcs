<?php

App::uses('AppController', 'Controller');
class MessagesController extends AppController{
  

  public function ajax_list($recipient_id){
    $this->layout = 'ajax';

    $messages = $this->Message->find('all', array(
      'order' => array(
          'Message.created' => 'DESC'
      ),
      'conditions' => array(

        'OR' => array(
          array(
            'sender_id' => $this->Session->read('Auth.User.id'),
            'recipient_id' => $recipient_id
          ),
          array(
            'sender_id' => $recipient_id,
            'recipient_id' => $this->Session->read('Auth.User.id')
          )
        )
      ),
      'limit' => 10
    ));

    $messages = array_reverse($messages);
    $this->set(compact('messages'));
  }

  public function index(){

  }  

  public function send(){

    if($this->request->is('ajax') && $this->request->is('post')){
      $this->request->data['Message']['sender_id'] = $this->Session->read('Auth.User.id');
      $this->Message->save($this->request->data);

      $this->set('response', $this->request->data);
      $this->set('_serialize', array('response'));
    }
  }

  public function view($username){
    $this->Message->Recipient->Behaviors->attach('Containable');

    $recipient = $this->Message->Recipient->find('first', array(
      'contain' => false,
      'fields' => array('id'),
      'conditions' => array(
        'username' => $username
      )
    ));

    $this->set(compact('recipient'));
  }
}

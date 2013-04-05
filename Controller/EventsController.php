<?php

App::uses('AppController', 'Controller');
class EventsController extends AppController{
  
  public function index(){ }
  public function view($id = null){ }

  public function add(){ 

    $this->Event->Committee->CommitteeUser->Behaviors->attach('Containable');

    if($this->request->is('post')){
      debug($this->request->data);
      exit;
    }

    $committees = $this->Event->Committee->find('list');
    $current_committee = $this->Event->Committee->CommitteeUser->find('first', array(
      'conditions' => array(
        'user_id' => $this->Session->read('Auth.User.id')
      ),
      'contain' => array(
        'Committee' => array(
          'fields' => array('name')
        )
      )
    ));

    $current_committee = $current_committee['Committee']['name'];
    $this->set(compact('committees', 'current_committee'));
  }


  public function edit($id = null){ }
  public function delete($id = null){ }



}

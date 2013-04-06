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
    $this->set(compact('committees'));
  }


  public function edit($id = null){ }
  public function delete($id = null){ }



}

<?php

App::uses('AppController', 'Controller');
class EventsController extends AppController{
  
  public function index(){
    $this->Event->Behaviors->attach('Containable');
    $this->paginate = array(
      'contain' => false,
      'limit' => 10
    );

    $events = $this->paginate();
    $this->set(compact('events'));
  }

  public function view($id = null){

    $this->Event->id = $id;
    if(!$this->Event->exists()){
      $this->redirect(array('action' => 'index'));
    }


  }

  public function add(){ 

    $this->Event->Committee->CommitteeUser->Behaviors->attach('Containable');

    if($this->request->is('post')){

      if($this->Event->save($this->request->data)){
        $this->Session->setFlash(__('Event created'));
        $this->redirect(array('action' => 'index'));
      }else{
        $this->Session->setFlash(__('Uh-oh! Something went wrong'));
      }
    }

    $committees = $this->Event->Committee->find('list');
    $this->set(compact('committees'));
  }


  public function edit($id = null){ }
  public function delete($id = null){ }



}

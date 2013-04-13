<?php

App::uses('AppController', 'Controller');
class EventsController extends AppController{
  
  public function index(){
    $this->Event->Behaviors->attach('Containable');
    $this->paginate = array(
      'contain' => array(
        'Rsvp' => array(
          'conditions' => array('user_id' => $this->Session->read('Auth.User.id')),
        )
      ),
      'limit' => 10,
      'order' => array(
        'date' => 'DESC'
      )
    );

    $events = $this->paginate();
    $this->set(compact('events'));
  }

  public function view($id = null){

    $this->Event->Behaviors->attach('Containable');

    $this->Event->id = $id;
    if(!$this->Event->exists()){
      $this->redirect(array('action' => 'index'));
    }

    $this->Event->contain(array('Rsvp' => array('User')));
    $this->set('event', $this->Event->read());
  }

  public function add(){ 

    $this->Event->Committee->CommitteeUser->Behaviors->attach('Containable');

    if($this->request->is('post')){
      $this->Event->User->Behaviors->attach('Containable');

      $this->request->data['Event']['user_id'] = $this->Session->read('Auth.User.id');
      $this->request->data['Event']['is_public'] = 1;

      $rsvps = array();
      $users = $this->Event->User->find('all', array(
        'contain' => false,
        'fields' => array('id')
      ));

      

      if($this->Event->save($this->request->data)){
        foreach($users as $key => $user){
          $rsvps[$key]['Rsvp']['user_id'] = $user['User']['id'];
          $rsvps[$key]['Rsvp']['event_id'] = $this->Event->id;
        }

        $this->Event->Rsvp->saveAll($rsvps);

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

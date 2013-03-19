<?php

App::uses('AppController', 'Controller');
class DiscussionsController extends AppController{
  

  public function create($type = ''){
   
    if($this->request->is('post')){
      $this->Discussion->Committee->Behaviors->attach('Containable');

      $committee = $this->Discussion->Committee->find('first', array(
        'conditions' => array(
          'Committee.name' => str_replace('_', ' ', $type)
        ),
        'comtain' => false
      ));

      $this->request->data['Post']['user_id'] = $this->Session->read('Auth.User.id');
      $this->request->data['Discussion']['user_id'] = $this->Session->read('Auth.User.id');
      $this->request->data['Discussion']['committee_id'] = $committee['Committee']['id'];

      if($this->Discussion->saveAll($this->request->data)){
        $this->Session->setFlash(__('Discussion created'));
        $this->redirect(array(
          'controller' => 'committees',
          'action' => 'view',
          $type
        ));
      }else{
        $this->Session->setFlash(__("Uh-oh something's wrong"));
      }

    }

  }


}

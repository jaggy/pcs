<?php

App::uses('AppController', 'Controller');
class CommitteesController extends AppController{

  /**
   * Add committees
   */
  public function add() {
    if($this->request->is('post')){
      $this->Committee->create();

      if($this->Committee->save()){
        $this->Session->setFlash(__('Committee created successfully'));
        $this->redirect(array('action' => 'index'));
      }
    }
  }  

  
}

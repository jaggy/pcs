<?php

App::uses('AppController', 'Controller');
class CommitteesController extends AppController{


  /**
   * Lets the user join a committee
   *   
   */
  public function join(){
    $this->set('committees', $this->Committee->find('list'));
  }

  /**
   * Display all the committees
   * 
   */
  public function index(){
    $this->Committee->recursive = 0;
    $this->set('committees', $this->paginate());  
  }

  /**
   * Add committees
   * 
   */
  public function add() {
    if($this->request->is('post')){
      $this->Committee->create();

      if($this->Committee->save($this->request->data)){
        $this->Session->setFlash(__('Committee created successfully'));
        $this->redirect(array('action' => 'index'));
      }
    }
  }  


}

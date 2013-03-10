<?php

App::uses('AppController', 'Controller');
class UsersController extends AppController{

  /**
   * Registers the user
   * 
   */
  public function register(){
    if($this->request->is('post')){
      $this->User->create();

      if($this->User->save($this->request->data)){
        $this->Session->setFlash(__('Successfully saved user'));
        $this->redirect('/');
      }else{
        $this->Session->setFlash(__('The user could not be saved. Please try again.'));
      }

    }
  }

}

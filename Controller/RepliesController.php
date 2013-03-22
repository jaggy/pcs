<?php

App::uses('AppController', 'Controller');
class RepliesController extends AppController{

  public function add(){

    if($this->request->is('post')){

      $this->request->data['user_id'] = $this->Session->read('Auth.User.id');

      $response = ($this->Reply->save($this->request->data)) ? true : false;

      $this->set('response', $response);
      $this->set('_serialize', array('response'));
    }

  }
}

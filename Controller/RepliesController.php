<?php

App::uses('AppController', 'Controller');
class RepliesController extends AppController{

  public function add(){

    if($this->request->is('ajax') && $this->request->is('post')){

      $this->request->data['user_id'] = $this->Session->read('Auth.User.id');

      $save = $this->Reply->save($this->request->data);
      if($save){
        $save['User']['first_name'] = $this->Session->read('Auth.User.first_name');
        $save['User']['middle_name'] = $this->Session->read('Auth.User.middle_name');
        $save['User']['last_name'] = $this->Session->read('Auth.User.last_name');
        $save['User']['username'] = $this->Session->read('Auth.User.username');
        // $save['']
      }

      $this->set('response', $save);
      $this->set('_serialize', array('response'));
    }

  }
}

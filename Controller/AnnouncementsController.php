<?php

App::uses('AppController', 'Controller');
class AnnouncementsController extends AppController{
  
    public function index(){}
    
    public function view($id = null){

      $this->Announcement->id = $id;

      if(!$this->Announcement->exists()){
        $this->redirect(array('action' => 'index'));
      }

      $this->set('announcement', $this->Announcement->read());
    }
    
    public function add(){

      if($this->request->is('post')){

        $this->request->data['Announcement']['user_id'] = $this->Session->read('Auth.User.id');

        if($this->Announcement->save($this->request->data)){
          $this->Session->setFlash(__('Announcement created successfully!'));
          $this->redirect(array('action' => 'view', $this->Announcement->id));
        }else{
          $this->Session->setFlash(__('Something went wrong'));
        }
      }
    }

    public function edit($id = null){}
    
    public function delete($id = null){}

}

<?php

App::uses('AppController', 'Controller');
class AnnouncementsController extends AppController{

    public $helpers = array(
      'Markdown'
    );
  
    public function index(){

      $this->paginate = array(
        'limit' => 6,
        'order' => array(
          'Announcement.created' => 'DESC'
        )
      );
      
      $this->set('announcements', $this->paginate('Announcement'));
    }

    
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

    public function edit($id = null){

      $this->Announcement->id = $id;

      if(!$this->Announcement->exists()){
        $this->redirect(array('action' => 'index'));
      }

      if($this->request->is('post') || $this->request->is('put')){

        if($this->Announcement->save($this->request->data)){
          $this->Session->setFlash(__('Announcement updated'));
          $this->redirect(array('action' => 'view', $this->Announcement->id));
        }else{
          $this->Session->setFlash(__('Uh-oh! Something went wrong'));
        }

      }else{
        $this->request->data = $this->Announcement->read();
      }

      $this->set('id', $this->Announcement->id);
    }
    

    public function delete($id = null){

      $this->Announcement->id = $id;

      if(!$this->Announcement->exists()){
        $this->redirect(array('action' => 'index'));
      }

      if($this->Announcement->delete()){
        $this->Session->setFlash(__('Announcement deleted'));
        $this->redirect(array('action' => 'index'));
      }

      $this->Session->setFlash(__('Uh-oh! Something went wrong'));
      $this->redirect(array('action' => 'index'));

    }

}

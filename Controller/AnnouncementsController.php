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

      $submitted = $this->Announcement->Attachment->find('first', array(
        'conditions' => array(
          'announcement_id' => $this->Announcement->id,
          'user_id' => $this->Session->read('Auth.User.id')
        )
      ));

      if($this->request->is('post')){

        $basename = $this->data['Attachment']['file']['name'];
        $extension = pathinfo($basename, PATHINFO_EXTENSION);
        $filename = $this->Session->read('Auth.User.username') . ".{$extension}";
        $destination = Configure::read('Data.attachments') . $this->Announcement->id . '/' . $filename;
        $tmp = $this->request->data['Attachment']['file']['tmp_name'];

        $this->request->data['Attachment']['name'] = $filename;
        $this->request->data['Attachment']['mimetype'] = $this->request->data['Attachment']['file']['type'];
        $this->request->data['Attachment']['size'] = $this->request->data['Attachment']['file']['size'];
        $this->request->data['Attachment']['path'] = Configure::read('Data.attachments') . $this->Announcement->id . "/.{$filename}";
        $this->request->data['Attachment']['announcement_id'] = $this->Announcement->id;
        $this->request->data['Attachment']['user_id'] = $this->Session->read('Auth.User.id');
        unset($this->request->data['Attachment']['file']);

        if($this->Announcement->Attachment->save($this->request->data)){
          move_uploaded_file($tmp, $destination);
          $this->Session->setFlash(__('Uploaded successfully!'));
          $this->redirect(array('action' => 'view', $this->Announcement->id));
        }
        
      }

      $announcement = $this->Announcement->read();
      $this->set(compact('announcement', 'submitted'));
    }
    
    public function add(){

      if($this->request->is('post')){

        $this->request->data['Announcement']['user_id'] = $this->Session->read('Auth.User.id');


        if($this->Announcement->save($this->request->data)){
          if($this->request->data['Announcement']['request_file']){
            $folder = Configure::read('Data.attachments') . $this->Announcement->id;
            mkdir($folder);
          }


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


        $this->request->data['Announcement']['image'] = array_filter($this->request->data['Announcement']['image']);
 
        if(!isset($this->request->data['Announcement']['image']['name'])){
          unset($this->request->data['Announcement']['image']);
        }

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

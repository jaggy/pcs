<?php

App::uses('AppController', 'Controller');
class DiscussionsController extends AppController{
  

  /**
   * View the discussion
   * @param  int $id 
   */
  public function view($id = ''){

    $this->Discussion->Post->Behaviors->attach('Containable');

    $discussion = $this->Discussion->find('first', array(
      'conditions' => array('Discussion.id' => $id),
      'contain' => array(
        'User' => array(
          'fields' => array('username', 'first_name', 'last_name')
        )
      )
    ));

    if(!$discussion){
      $this->redirect('/');
    }
  
    $this->paginate = array(
      'limit' => 5,
      'conditions' => array(
        'Post.discussion_id' => $id,
      ),
      'contain' => array(
        'User' => array(
          'fields' => array('username', 'first_name', 'last_name', 'image', 'created'),
          'Role' => array(
            'fields' => array('name')
          )
        ),
        'Reply' => array(
          'User' => array(
            'fields' => array('username', ' first_name', 'middle_name', 'last_name')
          )
        )
      )
    );

    $posts = $this->paginate('Post');

    $this->set(compact('discussion', 'posts'));
  }

  /**
   * Create a new dicussion with post content
   * @param  string $type 
   * 
   */
  public function create($type = ''){
   
    if($this->request->is('post')){
      $this->Discussion->Committee->Behaviors->attach('Containable');

      $committee = $this->Discussion->Committee->find('first', array(
        'conditions' => array(
          'Committee.name' => str_replace('_', ' ', $type)
        ),
        'contain' => false
      ));

      $this->request->data['Discussion']['user_id'] = $this->Session->read('Auth.User.id');
      $this->request->data['Discussion']['committee_id'] = $committee['Committee']['id'];

      if($this->Discussion->save($this->request->data)){
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

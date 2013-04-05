<?php

App::uses('AppController', 'Controller');
class DiscussionsController extends AppController{
  
  public $helpers = array('Editor');

  public function index(){
    $this->Discussion->Behaviors->attach('Containable');
    $this->Discussion->Committee->CommitteeUser->Behaviors->attach('Containable');

    $committee = $this->Discussion->Committee->CommitteeUser->find('first', array(
      'conditions' => array(
        'user_id' => $this->Session->read('Auth.User.id')
      ),
    ));

    $this->paginate = array(
      'limit' => 5,
      'order' => array('Discussion.last_updated' => 'DESC'),
      'fields' => array('title', 'id', 'post_count', 'view_count', 'last_updated', 'created'),
      'contain' => array(
        'User' => array(
          'fields' => array('username')
        ),
        'Post' => array(
          'fields' => array('id'),
          'order' => array('modified' => 'DESC'),
          'limit' => 1,
          'User' => array(
            'fields' => array('username')
          )
        )
      )
    );

    $discussions = $this->paginate('Discussion');

    $this->set(compact('discussions'));
  }


  /**
   * Reply to a discussion
   * @param  int $discussion_id 
   * 
   */
  public function reply($discussion_id = null){

    $this->Discussion->Behaviors->attach('Containable');

    $this->Discussion->id = $discussion_id;
    if(!$this->Discussion->exists()){
      $this->redirect(array('action' => 'view', $discussion_id));
    }

    if($this->request->is('post')){

      $this->request->data['Post']['discussion_id'] = $discussion_id;
      $this->request->data['Post']['user_id'] = $this->Session->read('Auth.User.id');


      if($this->Discussion->Post->save($this->request->data)){
        $this->Discussion->id = $discussion_id;
        $this->Discussion->saveField('last_updated', date('Y-m-d H:i:s'));
        $this->Session->setFlash(__('Successfully replied.'));
        $this->redirect(array('action' => 'view', $discussion_id));

      }else{
        $this->Session->setFlash(__('Uh-oh! Something went wrong'));
      }

    }

    $this->Discussion->contain(array(
      'Post' => array(
        'order' => array('created' => 'ASC'),
        'fields' => array('content'),
        'limit' => 1
      )
    ));
    $discussion = $this->Discussion->read();
    $initial_post = array_shift(reset($discussion['Post']));


    $this->set(compact('discussion', 'initial_post'));

  }

  /**
   * View the discussion
   * @param  int $id 
   */
  public function view($id = ''){

    $this->Discussion->Behaviors->attach('Containable');
    $this->Discussion->Post->Behaviors->attach('Containable');

    $this->Discussion->id = $id;

    if(!$this->Discussion->exists()){
      $this->redirect('/');
    }

    $this->Discussion->contain(array(
      'User'
    ));
    $discussion = $this->Discussion->read();
    $this->Discussion->saveField('view_count', $discussion['Discussion']['view_count']+ 1);

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
      $this->request->data['Post']['user_id'] = $this->Session->read('Auth.User.id');
      $this->request->data['Discussion']['committee_id'] = $committee['Committee']['id'];
      $this->request->data['Discussion']['last_updated'] = date('Y-m-d H:i:s');

      if($this->Discussion->Post->saveAll($this->request->data)){
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

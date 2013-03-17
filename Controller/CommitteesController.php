<?php

App::uses('AppController', 'Controller');
class CommitteesController extends AppController{


  /**
   * Display the committee
   * 
   */
  public function view($name){
    $this->Committee->Behaviors->attach('Containable');
    $this->Committee->CommitteeUser->Behaviors->attach('Containable');

    $name = ucwords(str_replace('_', ' ', $name));

    $pending = $this->Committee->CommitteeUser->find('first', array(
      'conditions' => array(
        'CommitteeUser.user_id' => $this->Session->read('Auth.User.id')
      ),
      'contain' => false
    ));

    $committee = $this->Committee->find('first', array(
      'conditions' => array(
        'Committee.name' => $name
      ),
      'contain' => array(
        'CommitteeUser' => array(
          'User' => array(
            'fields' => array('first_name', 'middle_name', 'last_name', 'username', 'image')
          ),
          'conditions' => array(
            'CommitteeUser.user_id !=' =>  $this->Session->read('Auth.User.id'),
            'CommitteeUser.approved' => true
          ),
          'limit' => 10
        ), 
        'User' => array(
          'fields' => array('first_name', 'middle_name', 'last_name', 'username', 'image', 'description')
        )
      )
    ));

    $this->set(compact('committee', 'pending'));
  }

  /**
   * Lets the user join a committee
   *   
   */
  public function join(){

    if($this->Session->read('Auth.User.Role.name') === 'Member' && $this->Session->read('Auth.User.committee_user_count') > 0){
      $this->Committee->CommitteeUser->Behaviors->attach('Containable');

      $committee = $this->Committee->CommitteeUser->find('first', array(
        'conditions' => array(
          'CommitteeUser.user_id' => $this->Session->read('Auth.User.id')
        ),
        'contain' => 'Committee'
      ));
      $this->redirect(array('action' => 'view', strtolower($committee['Committee']['name'])));
    }

    if($this->request->is('post')){

      $this->request->data['CommitteeUser']['user_id'] = $this->Session->read('Auth.User.id');
      if($this->Committee->CommitteeUser->save($this->request->data)){
        $this->Committee->CommitteeUser->User->Behaviors->attach('Containable');

        $user = $this->Committee->CommitteeUser->User->find('first', array(
          'conditions' => array(
            'User.id' => $this->Session->read('Auth.User.id')
          ),
          'contain' => array('Role', 'Committee')
        ));
        $session = $user['User'];

        unset($user['User']);
        $session = array_merge($session, $user);

        $this->Auth->login($session);
        $this->Session->setFlash(__('Joined committee'));
        $this->redirect(array('action' => 'index'));
      }else{
        $this->Session->setFlash(__('Something went wrong'));
      }

    }

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

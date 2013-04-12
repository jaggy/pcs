<?php

App::uses('AppController', 'Controller');
class CommitteesController extends AppController{


  /**
   * Approve or disapprove membership requests
   * 
   */
  public function pending(){
    $this->Committee->Behaviors->attach('Containable');

    if($this->request->is('post')){
      $this->Committee->CommitteeUser->User->Behaviors->attach('Containable');
      $this->Committee->CommitteeUser->Behaviors->attach('Containable');

      $committee_name = str_replace('_', ' ', $this->request->data['committee']);

      $user = $this->Committee->CommitteeUser->User->find('first', array(
        'fields' => array('id', 'username'),
        'conditions' => array(
          'User.username' => $this->request->data['username']
        ),
        'contain' => false
      ));


      $committee = $this->Committee->find('first', array(
        'fields' => array('id', 'name'),
        'conditions' => array(
          'Committee.name' => $committee_name
        ),
        'contain' => false
      ));

      $bridge = $this->Committee->CommitteeUser->find('first', array(
        'conditions' => array(
          'user_id' => $user['User']['id'],
          'committee_id' => $committee['Committee']['id']
        ),
        'contain' => false
      ));

      $this->Committee->CommitteeUser->id = $bridge['CommitteeUser']['id'];
      switch ($this->request->data['action']) {
        case 'approve':
          $save = ($this->Committee->CommitteeUser->save(array('approved' => true))) ? true : false;
          $this->set('response', $save);
        break;
        case 'disapprove':
          $this->set('response', $this->Committee->CommitteeUser->delete());
        break;
      }

      $this->set('_serialize', array('response'));
    }

    $committees = array();
    $results = $this->Committee->find('all', array(
      'fields' => array('name', 'description', 'chairman_id'),
      'contain' => array(
        'CommitteeUser' => array(
          'conditions' => array(
            'approved' => false
          ),
          'User' => array(
            'fields' => array('username', 'first_name', 'middle_name', 'last_name', 'image', 'description')
          )
        )
      )
    ));


    foreach($results as $result){
      if(!$result['CommitteeUser']) continue;
      $committees[] = $result;
    }

    $this->set(compact('committees'));
  }

  /**
   * Display the committee
   * 
   */
  public function view($name){
    $this->Committee->Behaviors->attach('Containable');
    $this->Committee->CommitteeUser->Behaviors->attach('Containable');

    $name = ucwords(str_replace('_', ' ', $name));

    $pending = $this->Committee->find('first', array(
      'conditions' => array(
        'Committee.name' => $name
      ),
      'contain' => array(
        'CommitteeUser' => array(
          'conditions' => array(
            'CommitteeUser.user_id' => $this->Session->read('Auth.User.id')
          )
        )
      )
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
        'Chairman' => array(
          'fields' => array('first_name', 'middle_name', 'last_name', 'username', 'image', 'description')
        ),
        'CoChairman' => array(
          'fields' => array('first_name', 'middle_name', 'last_name', 'username', 'image', 'description')
        ),
        'Discussion' => array(
          'order' => array(
            'created' => 'DESC'
          )
        )
      )
    ));



    $this->set(compact('committee', 'pending'));
    $this->set('_serialize', array('committee'));
  }

  /**
   * Lets the user join a committee
   *   
   */
  public function join(){

    $this->Committee->Behaviors->attach('Containable');

    if($this->Session->read('Auth.User.Role.name') === 'Member' && $this->Session->read('Auth.User.committee_user_count') > 0){
      $this->Committee->CommitteeUser->Behaviors->attach('Containable');

      $committee = $this->Committee->CommitteeUser->find('first', array(
        'conditions' => array(
          'CommitteeUser.user_id' => $this->Session->read('Auth.User.id')
        ),
        'contain' => 'Committee'
      ));

      $this->redirect(array('action' => 'view', strtolower(str_replace(' ', '_', $committee['Committee']['name']))));
    }


    if($this->request->is('post')){
      $this->request->data['CommitteeUser']['user_id'] = $this->Session->read('Auth.User.id');

      if($this->Committee->CommitteeUser->save($this->request->data)){
        $this->Committee->CommitteeUser->User->Behaviors->attach('Containable');

        $user = $this->Committee->CommitteeUser->User->find('first', array(
          'conditions' => array(
            'User.id' => $this->Session->read('Auth.User.id')
          ),
          'contain' => array('Role', 'Chairman')
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

    $this->set('committees', $this->Committee->available());
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

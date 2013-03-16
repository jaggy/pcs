<?php

App::uses('AppController', 'Controller');
class UsersController extends AppController{


  public function settings($type = ''){
      
      if($this->request->is('post') || $this->request->is('put')){

        $this->request->data['User'] = array_filter($this->request->data['User']);
        $this->request->data['User']['image'] = array_filter($this->request->data['User']['image']);

        if(!isset($this->request->data['User']['image']['name'])){
          unset($this->request->data['User']['image']);
        }

        $this->User->id = $this->Session->read('Auth.User.id');
        if($this->User->save($this->request->data)){
          $this->redirect(array('action' => 'index'));
          $this->Session->setFlash(__('Profile updated'));
        }else{
          $this->Session->setFlash(__('Uh-oh. Something went wrong!'));
        }

      }else{
        $this->request->data = $this->User->find('first', array(
          'conditions' => array(
            "User.{$this->User->primaryKey}" => $this->Session->read('Auth.User.id')
          )
        ));
      }

  }


  public function login(){

    if($this->Auth->user()){
      $this->redirect('/', null, false);
    }

    if($this->request->is('post')){

      if($this->Auth->login()){
        $this->redirect($this->Auth->redirect());
      }else{
        $this->User->Behaviors->attach('Containable');
        $user = $this->User->find('first', array(
          'conditions' => array(
            'User.username' => $this->request->data['User']['username']
          ),
          'contain' => false
        ));

        if(isset($user['User']) && !$user['User']['status']){
          $this->Session->setFlash(__('Your account has not been activated'));
        }else{
          $this->Session->setFlash(__('Invalid username or password'));         
        }

      }

    }
  }

  public function logout(){
    $this->redirect($this->Auth->logout());
  }

  /**
   * Display all the users
   * 
   */
  public function index(){
    $this->User->Behaviors->attach('Containable');
    $users = $this->User->find('all', array(
      'contain' => 'Role'
    ));

    $this->set(compact('users'));
  }

  /**
   * Registers the user
   * 
   */
  public function register(){
    if($this->request->is('post')){
      $this->User->create();


      $this->request->data['User']['activation_key'] = String::uuid();
      if($this->User->saveAll($this->request->data)){
        $this->sendMail(
          $this->data['User']['email'], 
          'Account Activation', 
          "Activation key: " . Configure::read('Site.url') . "activate/{$this->data['User']['username']}?key={$this->data['User']['activation_key']}"
        );
        $this->Session->setFlash(__('Successfully saved user'));
        $this->redirect('/');
      }else{
        $this->Session->setFlash(__('The user could not be saved. Please try again.'));
      }


    }
  }

  /**
   * Activates the user account
   * @param  string $username
   * @return void
   */
  public function activate($username){
    $this->User->Behaviors->attach('Containable');
    $activation_key = (isset($this->params['url']['key'])) ? $this->params['url']['key'] : null;

    if(!$activation_key || !$username){
      $this->redirect('/');
    }

    $isValid = $this->User->find('first', array(
      'conditions' => array(
        'username'       => $username,
        'activation_key' => $activation_key        
      ),
      'contain' => false
    ));

    // Key isn't valid
    if(!$isValid){
      $this->Session->setFlash('Activation Key Invalid! <a href="#">Resend Activation Key</a>');
      $this->redirect('/');
    }

    $user = $isValid['User'];

    // Account already activated
    if($user['status']){
      $this->Session->setFlash('Account already activated!');
      $this->redirect('/');
    }

    $this->User->id = $user['id'];
    $this->User->saveField('status', true);
  }

}

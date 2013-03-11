<?php

App::uses('AppController', 'Controller');
class UsersController extends AppController{

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

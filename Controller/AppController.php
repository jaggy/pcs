<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {

  public $helpers = array('Html', 'Form', 'Session');
  public $components = array(
    'Session', 'Email', 
    'Auth' => array(
      'loginAction' => array('controller' => 'users', 'action' => 'login'),
      'logoutRedirect' => array('controller' => 'users', 'action' => 'login'),
      'logoutRedirect' => '/',
      'authenticate' => array(
        'Form' => array(
          'scope' => array('status' => 1)
        )
      )

    )
  );

  public function beforeFilter(){
    parent::beforeFilter();
  
    if(strstr($this->here, '.json')){
      $this->viewClass = 'Json';
    }

    
    $user_information = $this->Session->read('Auth.User');
    if($user_information) $user_information['Committee'] = $this->joined_committee();
    $this->set(compact('user_information'));
  }

  public function joined_committee(){
    App::uses('CommitteeUser', 'Model');
    $CommitteeUser = new CommitteeUser();
    $CommitteeUser->Behaviors->attach('Containable');
    $committee = $CommitteeUser->find('first', array('contain' => 'Committee', 'conditions' => array('user_id' => $this->Session->read('Auth.User.id'))));
    if(isset($committee['Committee'])) return  $committee['Committee'];
  }

  /**
   * Sends emails dynamically
   * @param  string $to      
   * @param  string $subject 
   * @param  text $message 
   * @return void
   */
  public function sendMail($to, $subject, $message){
    $this->Email->smtpOptions = array(
      'port'=>'465',
      'timeout'=>'30',
      'host' => 'ssl://smtp.gmail.com',
      'username'=> Configure::read('Email.username'),
      'password'=> Configure::read('Email.password')
    );

    $this->Email->delivery = 'smtp';
    $this->Email->subject = $subject;
    $this->Email->from = sprintf("Sender <%s>", Configure::read('Email.username'));
    $this->Email->to = "Recipient <{$to}>";
    $this->Email->send($message);
  }
}

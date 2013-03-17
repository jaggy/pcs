<?php

	Router::connect('/', array('controller' => 'pages', 'action' => 'display', 'home'));
	Router::connect('/pages/*', array('controller' => 'pages', 'action' => 'display'));

  /**
   * User
   */
  Router::connect('/users', array('controller' => 'users', 'action' => 'index')); 
  Router::connect('/register', array('controller' => 'users', 'action' => 'register')); 
  Router::connect('/activate/*', array('controller' => 'users', 'action' => 'activate'));

  /**
   * Committee
   */
  Router::connect('/committees', array('controller' => 'committees', 'action' => 'index'));
  Router::connect('/committee/join', array('controller' => 'committees', 'action' => 'join'));
  Router::connect('/committee/*', array('controller' => 'committees', 'action' => 'view'));

  
	CakePlugin::routes();

  // CakePHP default routes
	require CAKE . 'Config' . DS . 'routes.php';

<?php

	Router::connect('/', array('controller' => 'pages', 'action' => 'display', 'home'));
	Router::connect('/pages/*', array('controller' => 'pages', 'action' => 'display'));

  Router::connect('/users', array('controller' => 'users', 'action' => 'index')); 
  Router::connect('/register', array('controller' => 'users', 'action' => 'register')); 
  Router::connect('/activate/*', array('controller' => 'users', 'action' => 'activate'));
  
	CakePlugin::routes();

  // CakePHP default routes
	// require CAKE . 'Config' . DS . 'routes.php';

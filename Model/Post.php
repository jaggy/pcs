<?php

App::uses('AppModel', 'Model');
class Post extends AppModel {

    
    public $belongsTo = array(
      'Discussion' => array(
        'className' => 'Discussion',
        'foreignKey' => 'discussion_id'
      ),
      'ParentPost' => array(
        'className' => 'ParentPost',
        'foreignKey' => 'parent_id'
      ),
      'User' => array(
        'className' => 'User',
        'foreignKey' => 'user_id'
      )
    );

    public $hasOne = array(
      'ChildPost' => array(
        'className' => 'Post',
        'foreignKey' => 'parent_id',
        'dependent' => false
      )
    );

}
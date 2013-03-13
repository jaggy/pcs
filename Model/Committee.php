<?php

App::uses('AppModel', 'Model');
class Committee extends AppModel {

    public $hasAndBelongsToMany = array(
      'User' => array(
        'className' => 'User',
        'joinTable' => 'committees_users',
        'foreignKey' => 'committee_id',
        'associationForeignKey' => 'user_id',
        'unique' => 'keepExisting'
      )
    );

}
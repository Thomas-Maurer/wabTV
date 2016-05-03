<?php


namespace App\Model\Table;

use Cake\ORM\Table;

class SmileysUsersTable extends Table
{

  public function initialize(array $config)
  {

    $this->table('smileys_users');
    $this->addAssociations([
      'belongsTo' => [
        'Users' => ['className' => 'App\Model\Table\UsersTable']
      ]
    ]);
  }

}
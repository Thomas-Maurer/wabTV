<?php
namespace App\Model\Table;

use Cake\ORM\Table;

class MutedUsersTable extends Table
{

  public function initialize(array $config)
  {

    $this->addAssociations([
      'belongsTo' => [
        'Users' => ['className' => 'App\Model\Table\UsersTable']
      ]
    ]);
  }
}



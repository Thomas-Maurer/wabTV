<?php

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class UsersTable extends Table
{

    public function initialize(array $config) {

        $this->addAssociations([
          'hasMany' => [
            'MutedUsers' => ['className' => 'App\Model\Table\MutedUsersTable'],
            'PrivateMessagesUsers' => ['className' => 'App\Model\Table\PrivateMessagesUsersTable'],
          ],
          'hasOne' => [
            'SmileysUsers' => ['className' => 'App\Model\Table\SmileysUsersTable']
          ]
        ]);
    }
    public function validationDefault(Validator $validator)
    {
        return $validator
            ->notEmpty('username', "Un nom d'utilisateur est requis")
            ->notEmpty('password', 'Un mot de passe est requis');
    }

}
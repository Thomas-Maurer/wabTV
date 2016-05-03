<?php

namespace App\Model\Entity;

use Cake\Auth\DefaultPasswordHasher;
use Cake\ORM\Entity;
use Cake\ORM\TableRegistry;

class User extends Entity
{
    protected $_accessible = [
        '*' => true,
        'id' => false
    ];

    protected function _setPassword($password) {
        return (new DefaultPasswordHasher)->hash($password);
    }

    public function _getUser($id) {
        $user = TableRegistry::get('Users');
        $result = $user->get($id, [
          'contain' => ['MutedUsers','PrivateMessagesUsers', 'SmileysUsers']
        ])->toArray();
        unset($result['password']);

        return json_encode( $result);
    }


}
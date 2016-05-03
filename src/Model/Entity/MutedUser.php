<?php


namespace App\Model\Entity;
use Cake\Datasource\EntityTrait;
use Cake\ORM\Entity;
use Cake\ORM\TableRegistry;


class MutedUser extends Entity
{

  public function _getGlobalBanUsers() {
    $bannedUsers = TableRegistry::get('MutedUsers');
    $result = $bannedUsers->find('all', [
      'fields' => ['username_muted']
    ])
      ->where(['global = 1'])
    ->toArray();
    return json_encode($result);
  }

  public function _checkIfAlreadyInBanList ($userId, $userMuted) {
    $bannedUsers = TableRegistry::get('MutedUsers');
    $result = $bannedUsers->find('all')
        ->where([
            'user_id = ' . $userId,
            'username_muted = "' . $userMuted . '"'
        ])
        ->count();
    return $result;
  }

  public function _getRow ($userId, $userMuted) {
    $bannedUsers = TableRegistry::get('MutedUsers');
    $result = $bannedUsers->find('all')
        ->where([
            'user_id = ' . $userId,
            'username_muted = "' . $userMuted . '"'
        ]);
    return $result;
  }

}
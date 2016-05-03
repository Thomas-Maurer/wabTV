<?php


namespace App\Model\Entity;
use Cake\Datasource\EntityTrait;
use Cake\ORM\Entity;
use Cake\ORM\TableRegistry;

class PrivateMessagesUser extends Entity
{
  protected $_accessible = [
    'conversation' => false
  ];
  public function _getUserPM ($userId, $user_to_pm)
  {
    $UserPM = TableRegistry::get('PrivateMessagesUsers');
    $result = $UserPM->find('all')
      ->where([
        'user_id = ' . $userId,
        'user_to_pm = "' . $user_to_pm .'"'
      ]);
    return $result->first();
  }

  public function _checkIfAlreadyPmed ($userId, $user_to_pm) {
    $UserPM = TableRegistry::get('PrivateMessagesUsers');
    $result = $UserPM->find('all')
      ->where([
        'user_id = ' . $userId,
        'user_to_pm = "' . $user_to_pm .'"'
      ])
      ->count();
    return $result;
  }

  public function _updatePmUser ($userId, $userPM) {

  }

}
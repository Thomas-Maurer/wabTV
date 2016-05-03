<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\ORM\TableRegistry;

class SmileysUser extends Entity
{
    public function _checkIfUserHaveSmiley ($userId, $smileyId) {
        $User = TableRegistry::get('Users');
        $find = false;
        $result = $User->get($userId, [
            'contain' => ['SmileysUsers']
        ]);
        if($result->get('smileys_user') !== null){
            $result = $result->get('smileys_user');
            $smiley_available = json_decode($result->get('smileys_available'));
            foreach ($smiley_available as $smiley) {
                if($smiley->id == $smileyId) {
                    $find = true;
                }
            }
        }
        return $find;
    }

    public function _getSmileysUserId ($userId) {
        $User = TableRegistry::get('Users');
        $SmileyUser = TableRegistry::get('SmileysUsers');
        $result = $User->get($userId, [
            'contain' => ['SmileysUsers']
        ]);
        if($result->get('smileys_user') !== null){
            $result = $result->get('smileys_user')->get('id');
        }else {
            $init = new SmileysUser();
            $init->smileys_available= json_encode(array());
            $init->user_id= $userId;
            if($SmileyUser->save($init)){
                return $init->id;
            }
        }

        return $result;
    }
}
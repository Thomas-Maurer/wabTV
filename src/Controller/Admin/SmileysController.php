<?php

namespace App\Controller\Admin;

use App\Controller\AppController;
use App\Model\Entity\MutedUser;
use Cake\Event\Event;
use App\Model\Entity\Smiley;
use App\Model\Entity\SmileysUser;
use Cake\ORM\TableRegistry;

class SmileysController extends AppController
{
    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
    }


    public function create() {
        $smileysTable = TableRegistry::get('Smileys');
        $smiley = $smileysTable->newEntity();
        $folderToSaveFiles = WWW_ROOT . 'img/smileys/' ;
        $this->set('username', $this->Auth->user('username'));
        $this->set('smiley', $smiley);
        $this->set('path', $folderToSaveFiles);

        if ($this->request->is('post')){
            if(!empty($this->request->data))
            {
                $this->set('data', $this->request->data);
                //Check if image has been uploaded
                if(!empty($this->request->data['Smiley']['submittedSmiley']))
                {
                    $file = $this->request->data['Smiley']['submittedSmiley']; //put the data into a var for easy use

                    $ext = substr(strtolower(strrchr($file['name'], '.')), 1); //get the extension
                    $arr_ext = array('jpg', 'jpeg', 'gif', 'png'); //set allowed extensions

                    //only process if the extension is valid
                    if(in_array($ext, $arr_ext))
                    {
                        //do the actual uploading of the file. First arg is the tmp name, second arg is
                        //where we are putting it
                        $newFilename = $file['name']; // edit/add here as you like your new filename to be.
                        $result = move_uploaded_file( $file['tmp_name'], $folderToSaveFiles . $newFilename );
                        $smiley->url = "/smileys/" . $file['name'];

                        //prepare the filename for database entry (optional)
                        //$this->data['Image']['image'] = $file['name'];
                    }
                }
                $smiley->name = $this->request->data['Smiley']['name'];
                $smiley->comment = $this->request->data['Smiley']['comment'];

                //now do the save (optional)
                if($smileysTable->save($smiley)) {
                    $this->Flash->success('Smileys ajoutés !');
                } else {
                    $this->Flash->error('Smileys non ajoutés !');
                }
            }
        }

    }

    public function listAll() {
        $smileysTable = TableRegistry::get('Smileys');
        $this->set('smileys',$smileysTable->find('all')->toArray());
    }

    public function controlPanel () {

    }

    public function associateSmileyToUser () {
        $smileysTable = TableRegistry::get('Smileys');
        $usersTable = TableRegistry::get('Users');
        $UserSmileysTable = TableRegistry::get('SmileysUsers');
        $EntityUserSmileys = new SmileysUser();
        $listUsername = array();
        $listSmileysName = array();


        foreach ($usersTable->find('all')->toArray() as $user) {
            $listUsername[$user->id] = $user->username;
        }
        foreach ($smileysTable->find('all')->toArray() as $smiley) {
            $listSmileysName[$smiley->id] = $smiley->name;
        }
        $this->set('users', $listUsername);
        $this->set('smileys', $listSmileysName);

        if ($this->request->is('post')){
            if(!empty($this->request->data))
            {
                $userId = $this->request->data['userId'];
                $smileyId = $this->request->data['smileysId'];
                $currentSmiley = $smileysTable->get($smileyId);

                if(!$EntityUserSmileys->_checkIfUserHaveSmiley($userId, $smileyId)){
                    $userSmiley = $UserSmileysTable->get($EntityUserSmileys->_getSmileysUserId($userId));
                    if($userSmiley->get('smileys_user') !== null){
                        $smileysAvailable = $userSmiley->get('smileys_available');
                        $smileysAvailable = json_decode($smileysAvailable);
                        array_push($smileysAvailable, array(
                            'id' => $currentSmiley->get('id'),
                            'name'=>$currentSmiley->get('name'),
                            'url'=>$currentSmiley->get('url')));
                        $userSmiley->smileys_available = json_encode($smileysAvailable);
                    } else {
                        $initSmileysAvailable = new \stdClass();
                        $initSmileysAvailable->id =$currentSmiley->get('id');
                        $initSmileysAvailable->name =$currentSmiley->get('name');
                        $initSmileysAvailable->url =$currentSmiley->get('url');
                        $userSmiley->smileys_available = json_encode(array($initSmileysAvailable));
                    }

                    if($UserSmileysTable->save($userSmiley)){
                        $this->Flash->success("Smileys associés");
                    }else {
                        $this->Flash->success("Smileys non associés");
                    }
                }
            }
        }
    }
}
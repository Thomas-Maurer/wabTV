<?php

namespace App\Controller\Admin;

use App\Controller\AppController;
use App\Model\Entity\MutedUser;
use Cake\Event\Event;
use App\Model\Entity\User;
use Cake\ORM\TableRegistry;

class UsersController extends AppController {

    public function index() {
        $this->set('users', $this->Users->find('all'));
    }

    public function view($id) {
        $user = $this->Users->get($id);
        $this->set(compact('user'));
    }

    public function add() {
        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->data);
            if ($this->Users->save($user)) {
                $this->Flash->success(__("L'utilisateur a été sauvegardé."));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__("Impossible d'ajouter l'utilisateur."));
        }
        $this->set('user', $user);
    }

    //Rest call for AngularJS (chatController)
    public function getCurrentUser() {
        $user = new User();
        $user = $user->_getUser($this->Auth->user('id'));
        $this->response->body(($user));

        return $this->response;
    }

    public function login() {
        if ($this->request->is('post')) {
            $user = $this->Auth->identify();
            if ($user) {
                $this->Auth->setUser($user);
                return $this->redirect($this->Auth->redirectUrl(array( 'controller' => 'Admin', 'action' => 'index')));
            }
            $this->Flash->error(__("Nom d'utilisateur ou mot de passe incorrect, essayez à nouveau."));
        }
    }

    //Rest call
    public function getGlobalBanUsers() {
        $mutedUsers = new MutedUser();
        $mutedUsers = $mutedUsers->_getGlobalBanUsers();

        $this->response->body(($mutedUsers));

        return $this->response;
    }

    public function addMutedUsers() {
        $data = json_decode($this->request->input());

        $userTable = TableRegistry::get('Users');
        $mutedTable = TableRegistry::get('MutedUsers');
        $user = $userTable->get($this->Auth->user('id'));

        $mutedUser = $mutedTable->newEntity();

        if($mutedUser->_checkIfAlreadyInBanList($user->get('id'), $data->username_muted) === 0 ) {
            $mutedUser->set('username_muted', $data->username_muted);
            $mutedUser->set('global', false);
            $mutedUser->set('user', $user);

            if ($mutedTable->save($mutedUser)) {
                $this->response->body('true');
                $this->Flash->success(__("L'utilisateur a été ajouté à la liste des gens ignorés"));
            } else {
                $this->response->body('false');
                $this->Flash->error(__("L'utilisateur n'a pas été ajouté à la liste des gens ignorés"));
            }
        } else {
            $this->response->body('User already in ignore list');
        }

        return $this->response;
    }

    public function deleteMutedUser() {
        $data = json_decode($this->request->input());

        $userTable = TableRegistry::get('Users');
        $mutedTable = TableRegistry::get('MutedUsers');
        $user = $userTable->get($this->Auth->user('id'));

        $mutedUser = $mutedTable->newEntity();

        if($mutedUser->_checkIfAlreadyInBanList($user->get('id'), $data->username_muted) > 0 ) {
            $mutedUser = $mutedUser->_getRow($user->get('id'), $data->username_muted);
            if ($mutedTable->delete($mutedUser)) {
                $this->response->body('true');
                $this->Flash->success(__("L'utilisateur a été supprimé de la liste des gens ignorés"));
            } else {
                $this->response->body('false');
                $this->Flash->error(__("L'utilisateur n'a pas été supprimé de la liste des gens ignorés"));
            }
        } else {
            $this->response->body('User already in ignore list');
        }

        return $this->response;
    }

    public function deletepm() {
        $data = json_decode($this->request->input());

        $userTable = TableRegistry::get('Users');
        $pmTable = TableRegistry::get('PrivateMessagesUsers');
        $user = $userTable->get($this->Auth->user('id'));

        $pmUser = $pmTable->newEntity();

        if($pmUser->_checkIfAlreadyPmed($user->get('id'), $data->nameconversation) > 0 ) {
            $pmUser = $pmUser->_getUserPM($user->get('id'), $data->nameconversation);
            if ($pmTable->delete($pmUser)) {
                $this->response->body('true');
            } else {
                $this->response->body('false');
                }
        } else {
            $this->response->body('User already in ignore list');
        }

        return $this->response;
    }

    public function pmuser()
    {
        $data = json_decode($this->request->input());

        $userTable = TableRegistry::get('Users');
        $pmTable = TableRegistry::get('PrivateMessagesUsers');
        $usertopm = $userTable->get($this->Auth->user('id'));
        $userfrompm = $userTable->get($data->user_from_pm);

        $pm_userTable = $pmTable->newEntity();

        if ($pm_userTable->_checkIfAlreadyPmed($usertopm->get('id'), $data->user_to_pm) === 0) {
            //Create new conversation
            $conversation = array();
            $newMessage = array('username' => $this->Auth->user('username'),
              'message' => $data->new_message);
            array_push($conversation, $newMessage);
            $pm_userTable->set('user_to_pm', $data->user_to_pm);
            $pm_userTable->set('nameconversation', $data->user_to_pm);
            $pm_userTable->set('conversation', json_encode($conversation));
            $pm_userTable->set('user', $userfrompm);

            if ($pmTable->save($pm_userTable)) {
                $this->response->body('true');
            } else {
                $this->response->body('false');
            }
        } else {
            //Update current conversation
            $currentConversation = $pm_userTable->_getUserPM($usertopm->get('id'), $data->user_to_pm);

            $conversation = json_decode($currentConversation->conversation);
            $newMessage = json_encode(array('message' => $data->new_message,
                'username' => $this->Auth->user('username')));

            array_push($conversation, json_decode($newMessage));
            $currentConversation->conversation = json_encode($conversation);

            if ($pmTable->save($currentConversation)) {
                $this->response->body('true');
            } else {
                $this->response->body('false');
            }
        }
        return $this->response;
    }

    public function receivepm() {
        $data = json_decode($this->request->input());

        $userTable = TableRegistry::get('Users');
        $pmTable = TableRegistry::get('PrivateMessagesUsers');
        $usertopm = $userTable->get($data->user_to_pm);
        $userfrompm = $userTable->findByUsername($data->user_from_pm);
        $userfrompm = $userfrompm->first();

        $pm_userTable = $pmTable->newEntity();

        if($pm_userTable->_checkIfAlreadyPmed($usertopm->get('id'), $userfrompm->get('username')) === 0 ) {
            //Create new conversation
            $conversation = array();
            $newMessage = array('username' => $data->user_from_pm, 'message' => $data->new_message);
            array_push($conversation, $newMessage);
            $pm_userTable->set('user_to_pm', $data->user_from_pm);
            $pm_userTable->set('nameconversation', $data->user_from_pm);
            $pm_userTable->set('conversation', json_encode($conversation));
            $pm_userTable->set('user', $usertopm);

            if ($pmTable->save($pm_userTable)) {
                $this->response->body('true');
            } else {
                $this->response->body('false');
            }
        } else {
            //Update current conversation
            $currentConversationEntity = $pm_userTable->_getUserPM($usertopm->get('id'), $userfrompm->get('username'));

            $message = array();
            $message['username'] = $userfrompm->username;
            $message['message'] = $data->new_message;

            $conversation = (array)json_decode($currentConversationEntity->conversation);
            array_push($conversation, $message);
            $currentConversationEntity->set('conversation', json_encode($conversation));

            if ($pmTable->save($currentConversationEntity)) {
                $this->response->body('true');
            } else {
                $this->response->body('false');
            }
        }

        return $this->response;
    }
}


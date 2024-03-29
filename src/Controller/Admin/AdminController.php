<?php

namespace App\Controller\Admin;

use App\Controller\AppController;
use App\Model\Entity\MutedUser;
use Cake\Event\Event;
use App\Model\Entity\User;
use Cake\ORM\TableRegistry;

class AdminController extends AppController {

  public function beforeFilter(Event $event)
  {
    parent::beforeFilter($event);
    $this->viewBuilder()->layout('admin');
  }

  public function index() {
    $this->set('username', $this->Auth->user('username'));
  }

}


<?php
/**
 * Created by PhpStorm.
 * User: Wellan
 * Date: 08/05/2016
 * Time: 16:30
 */

namespace App\Controller\Admin;

use App\Controller\AppController;
use App\Model\Entity\MutedUser;
use Cake\Event\Event;
use App\Model\Entity\User;
use Cake\ORM\TableRegistry;
use Cake\Filesystem\File;

class TimelineController extends AppController
{
    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
    }


    public function controlPanel () {
        $file = new File(APP . "data" . DS . "prog.json");
        $programmation = $file->read(true, 'r');
        
    }
}
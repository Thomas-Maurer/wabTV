<?php
/**
 * Created by PhpStorm.
 * User: Wellan
 * Date: 04/05/2016
 * Time: 13:51
 */


namespace App\Controller;
use Cake\Filesystem\File;

class HomeController extends AppController
{
    
    public function getprog() {
        $file = new File(APP . "data" . DS . "prog.json");
        $programmation = $file->read(true, 'r');
        $this->autoRender = false;
        $this->response->type('json');

        $this->response->body($programmation);
    }
    

    public function home() {
        $twitchApi = new \stdClass();

        $InfoStream = $this->getAPI_Channel("weareb0b");
        $InfoLive = $this->getAPI_Stream("weareb0b");

        $twitchApi->InfoStream = $InfoStream;
        $twitchApi->InfoLive = $InfoLive;

        $this->set('twitchApi',$twitchApi);
    }

    public function getAPI_URI($type){
        $API_Base_URI = "https://api.twitch.tv/kraken/";
        $twitchAPI_Sections = array(
            "channels" 	=> $API_Base_URI."channels/",
            "user"		=> $API_Base_URI."user",
            "streams" 	=> $API_Base_URI."streams/"
        );
        return $twitchAPI_Sections[$type];
    }
    public function getAPI_Channel($name) {
        $url = file_get_contents($this->getAPI_URI("channels").urlencode($name));
        $channel = json_decode($url, true);
        if($channel["_id"] == ""){
            $InfosChannel = array(
                "status"	=>	"Impossible de charger les informations du channel !"
            );
            return $InfosChannel;
        }else{
            $InfosChannel = array(
                "mature"							=>  $channel["mature"],
                "status"							=>	$channel["status"],
                "broadcaster_language"				=>	$channel["broadcaster_language"],
                "display_name" 						=>	$channel["display_name"],
                "game"								=> 	$channel["game"],
                "language"							=>	$channel["language"],
                "_id" 								=>	$channel["_id"],
                "name" 								=>	$channel["name"],
                "created_at" 						=>	$channel["created_at"],
                "updated_at" 						=>	$channel["updated_at"],
                "delay"								=>	$channel["delay"],
                "logo" 								=>	$channel["logo"],
                "banner" 							=>	$channel["banner"],
                "video_banner" 						=>	$channel["video_banner"],
                "background" 						=>	$channel["background"],
                "profile_banner" 					=>	$channel["profile_banner"],
                "profile_banner_background_color" 	=>	$channel["profile_banner_background_color"],
                "partner"							=>	$channel["partner"],
                "url" 								=>	$channel["url"],
                "views" 							=>	$channel["views"],
                "followers" 						=>	$channel["followers"]
            );
            return $InfosChannel;
        }
    }

    public function getAPI_Stream($name) {
        $url = file_get_contents($this->getAPI_URI("streams").urlencode($name));
        $stream = json_decode($url, true);
        if($stream["stream"]["_id"] == ""){
            $InfosStream = array(
                "game"	=>	"Impossible de charger les informations du live !",
                "viewers" => ""
            );
            return $InfosStream;
        }else{
            $InfosStream = array(
                "_id"			=>	$stream["stream"]["_id"],
                "game"			=>	$stream["stream"]["game"],
                "viewers" 		=>	$stream["stream"]["viewers"],
                "created_at" 	=>	$stream["stream"]["created_at"],
                "video_height" 	=>	$stream["stream"]["video_height"],
                "average_fps" 	=>	$stream["stream"]["average_fps"],
                "delay" 		=>	$stream["stream"]["delay"],
                "is_playlist"	=>	$stream["stream"]["is_playlist"]
            );
            return $InfosStream;
        }
    }
}
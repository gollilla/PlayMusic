<?php


namespace soradore\playmusic;

use pocketmine\network\mcpe\protocol\{
    PlaySoundPacket,
    StopSoundPacket
};
use pocketmine\Server;

class api
{
    /**
     * @var null
     */
    private static $now_play = null;

    static function playMusic(string $name)
    {
        if(self::$now_play != null){
            self::stopMusic(self::$now_play);
        }
        var_dump(self::$now_play, $name);
        if(self::$now_play == $name){
            self::stopMusic();
            self::$now_play = null;
            return;
        }
        $players = Server::getInstance()->getOnlinePlayers();
        $packet = new PlaySoundPacket;
        $packet->soundName = $name;
        $packet->volume = 1.0;
        $packet->pitch = 1.0;
        foreach ($players as $player){
            $packet->x = $player->getX();
            $packet->y = $player->getY();
            $packet->z = $player->getZ();
            $player->dataPacket($packet);
        }
        self::$now_play = $name;
    }

    static function stopMusic(string $name = null)
    {
        $packet = new StopSoundPacket;
        if($name == null){
            $packet->stopAll = true;
            $packet->soundName = "dummy.sound";
        }else{
            $packet->soundName = $name;
        }
        Server::getInstance()->broadcastPacket(Server::getInstance()->getOnlinePlayers(), $packet);
        //self::$now_play = null;
    }
}
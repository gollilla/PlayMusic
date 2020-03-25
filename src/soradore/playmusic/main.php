<?php


namespace soradore\playmusic;

use pocketmine\plugin\PluginBase;
use pocketmine\form\Form;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\utils\Config;
use soradore\playmusic\form\playUI;
use pocketmine\Player;

class main extends PluginBase
{
    /**
     * @var Config
     */
    private $music_list;

    function onEnable()
    {
        $this->music_list = new Config($this->getDataFolder() . "music_list.yml", Config::YAML,[
            "music.test" => [
                "button" => "§aテスト"
            ]
        ]);
    }

    function onCommand(CommandSender $sender, Command $command, string $label, array $args): bool
    {
        if(!($sender instanceof Player)){
            $sender->sendMessage("§eゲーム内でしか使えません\n");
        }
        switch($label){
            case "play":
                $sender->sendForm(new playUI($this->music_list));
                break;
        }
        return true;
    }
}
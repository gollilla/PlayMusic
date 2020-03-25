<?php

namespace soradore\playmusic\form;

use pocketmine\utils\Config;
use pocketmine\form\Form;
use pocketmine\Player;
use soradore\playmusic\api;
class playUI implements Form {

    /**
     * @var Config
     */
    private $music_list;
    /**
     * @var array
     */
    private $play_list;


    public function __construct(Config $music_list)
    {
        $this->music_list = $music_list;
        $play_list = [];
        foreach ($music_list->getAll() as $key => $music) {
            $play_list[] = [
                "text" => $music['button'],
                "name" => $key
            ];
        }
        $this->play_list = $play_list;
        //var_dump($play_list);
        //var_dump($music_list->getAll());
    }

    public function handleResponse(Player $player, $data): void
    {
        if($data !== null)
            api::playMusic($this->play_list[$data]["name"]);
    }

    public function jsonSerialize(){
        
        return [
            "type" => "form",
            "title" => "§eプレイリスト",
            "content" => "§b流したい曲を選択",
            "buttons" => $this->play_list
        ];
    }
}
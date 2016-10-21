<?php

namespace paceeGameBundle\GameManager;

use Doctrine\Common\Collections\ArrayCollection;
use paceeGameBundle\Entity\Game;

class paceeGameManager {

    private $games;

    public function __construct() {
        $directory = 'games';
        $this->games = new ArrayCollection();
        $scan = array_diff(scandir($directory), array('..', '.'));
        foreach ($scan as $file) {
            if (is_dir("games/$file")) {
                $json = $this->getData("games/" . $file . "/infos.json");
                $data = json_decode($json, true);

                $game = new Game();
                $game->setTitle($data["title"])->setInfos($data["infos"])->setName($data["name"])->setWidth($data["w"])->setHeight($data["h"])->setUri($file);
                $this->games->set($file, $game);
            }
        }
    }

    public function getCount() {

        return $this->games->count();
    }

    private function getData($filename) {
        if (isset($filename)) {


            $myfile = fopen($filename, "r") or die("Unable to open file!");
            $data = fread($myfile, filesize($filename));
            fclose($myfile);
            return $data;
        }
    }

    public function getGames()
      {
      return $this->games;
      } 


}

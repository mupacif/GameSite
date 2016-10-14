<?php

namespace paceeGameBundle\Entity;

class Game
{
    private $uri;
    private $title;
    private $infos;
    private $name;
    private $width;
    private $height;
    
    
    public function getUri() {
        return $this->uri;
    }

    public function setUri($uri) {
        $this->uri = $uri;
        return $this;
    }

        
    public function getTitle() {
        return $this->title;
    }

    public function getInfos() {
        return $this->infos;
    }

    public function getName() {
        return $this->name;
    }

    public function getWidth() {
        return $this->width;
    }

    public function getHeight() {
        return $this->height;
    }

    public function setTitle($title) {
        $this->title = $title;
        return $this;
    }

    public function setInfos($infos) {
        $this->infos = $infos;
        return $this;
    }

    public function setName($name) {
        $this->name = $name;
        return $this;
    }

    public function setWidth($width) {
        $this->width = $width;
        return $this;
    }

    public function setHeight($height) {
        $this->height = $height;
        return $this;
    }


    
}

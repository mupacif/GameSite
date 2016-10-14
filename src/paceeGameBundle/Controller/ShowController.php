<?php

namespace paceeGameBundle\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class ShowController extends Controller {

    /**
     * @Route("/")
     */
    public function indexAction() {

        $gameManager = $this->container->get('pacee_game.GameManager');
        //return new Response($gameManager->getCount());
        return $this->render('paceeGameBundle:Default:index.html.twig', array('games' => $gameManager->getGames()));
    }

    public function showAction($name) {

        $gameManager = $this->container->get('pacee_game.GameManager');
        $game = $gameManager->getGames()->get($name);

        if (isset($game)) {
            
           return $this->render('paceeGameBundle:Default:game.html.twig', array('game' => $game));
        } else {
            return new Response("doesn't exist");
        }
    }

}

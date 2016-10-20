<?php

namespace paceeGameBundle\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use paceeGameBundle\Entity\Game;

class ShowController extends Controller {

    /**
     * @Route("/")
     */
    public function indexAction() {

        $gameManager = $this->container->get('pacee_game.GameManager');
        //return new Response($gameManager->getCount());
        return $this->render('paceeGameBundle:Default:index.html.twig', array('games' => $gameManager->getGames()));
    }

    /**
     * Show games
     */
    public function showAction($name) {

        $gameManager = $this->container->get('pacee_game.GameManager');
        $game = $gameManager->getGames()->get($name);

        if (isset($game)) {

            return $this->render('paceeGameBundle:Default:game.html.twig', array('game' => $game));
        } else {
            return new Response("doesn't exist");
        }
    }

    public function addGameAction(Request $request) {
        $game = new Game();

        $form = $this->get('form.factory')->createBuilder(FormType::class, $game)
                ->add('uri', TextType::class)
                ->add('title', TextType::class)
                ->add('infos', TextareaType::class)
                ->add('name', TextType::class)
                ->add('width', IntegerType::class)
                ->add('height', IntegerType::class)
                ->add('categories', EntityType::class, array(
                    'class' => 'paceeGameBundle:Category',
                    'choice_label' => 'name',
                    'multiple' => true,
                    'expanded'=>true
                ))
                ->add('save', SubmitType::class)
                ->getForm();

        // Si la requête est en POST
        if ($request->isMethod('POST')) {
            // On fait le lien Requête <-> Formulaire
            // À partir de maintenant, la variable $advert contient les valeurs entrées dans le formulaire par le visiteur
            $form->handleRequest($request);

            // On vérifie que les valeurs entrées sont correctes
            // (Nous verrons la validation des objets en détail dans le prochain chapitre)
            if ($form->isValid()) {

                return new Response("GGG ");

                // return $this->redirectToRoute('oc_platform_view', array('id' => $advert->getId()));
            }
        }

        return $this->render('paceeGameBundle:Default:add.html.twig', array(
                    'form' => $form->createView()
        ));
    }

}

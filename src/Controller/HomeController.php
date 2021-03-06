<?php

namespace App\Controller;

use mysql_xdevapi\Exception;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     **/
    public function index() {
        if($this->getUser() === NULL) {
            return $this->render('index.html.twig', [
                'username' => '',
                'title' => ''
            ]);
        }
        else {
            return $this->render('index.html.twig', [
                'username' => $this->getUser()->getUsername(),
                'title' => ''
            ]);
        }
    }

    /**
     * @Route("/inscription", name="inscription")
     **/
    public function inscription() {
        return $this->render('inscription.html.twig', [
            'title' => 'Inscription'
        ]);
    }

    /**
     * @Route("/connexion", name="connexion")
     **/
    public function connexion() {
        return $this->render('connexion.html.twig', [
            'title' => 'Connexion'
        ]);
    }

}

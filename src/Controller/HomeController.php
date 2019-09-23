<?php

namespace App\Controller;

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
        return $this->render('index.html.twig', [
            'title' => 'Le Bon Coin'
        ]);
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

<?php

namespace App\Controller;

use mysql_xdevapi\Exception;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;

include 'C:\Users\bigre\Desktop\Symfony\leboncoin\public\bdd.php';
include 'C:\Users\bigre\Desktop\Symfony\leboncoin\public\inscription.php';

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

    /**
     * @Route("/bdd", name="bdd")
     **/
    public function bddConnection() {
        connection();
        $users = getAllUsers();
        return $this->render('bdd.html.twig', [
            'title' => 'bdd',
            'erreur' => 'aucune erreur mdr genre jai fait un truc qui marche mdr jpp le php cest tranquille',
            'users' => $users
        ]);
    }

    /**
     * @Route("/inscription_en_cours", name="inscription_en_cours")
     **/
    public function inscription_en_cours() {
        return $this->index();
    }
}

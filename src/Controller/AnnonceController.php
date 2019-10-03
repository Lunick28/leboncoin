<?php
/**
 * Created by PhpStorm.
 * User: tenma
 * Date: 03/10/2019
 * Time: 15:15
 */

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AnnonceController extends AbstractController
{
    /**
     * @Route("/annonce", name="annonce")
     **/
    public function enregistrementAnnonce() {
        return $this->render('annonces.html.twig', [
            'title' => 'Annonce'
        ]);
    }
}
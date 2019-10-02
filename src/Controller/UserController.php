<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;


class UserController extends AbstractController
{

    /**
     * @Route("/inscription_en_cours", name="inscription_en_cours")
     **/
    public function inscription(EntityManagerInterface $em, Request $request)
    {
        $user = new User();
        $user->setUsername($request->get('username')) 
            ->setPassword($request->get('password'));

        $em->persist($user);
        $em->flush();

        return $this->render('index.html.twig', [
            'title' => 'Bienvenue ' . $user->getUsername() . ', connectez-vous !'
        ]);
    }

    /**
     * @Route("/all_users", name="all_users")
     **/
    public function list(EntityManagerInterface $em)
    {
        $repository = $em->getRepository(User::class);

        $users = $repository->findAll();

        return new JsonResponse($users);
    }

    /**
     * @Route("/connexion_en_cours", name="connexion_en_cours")
     **/
    public function connexion(EntityManagerInterface $em, Request $request)
    {
        $user = new Users();
        $user->setEmail($request->get('email'))
            ->setPassword($request->get('password'));

        $kConnect = $request->get('keepConnect');

        $repository = $em->getRepository(Users::class);

        $users = $repository->findAll();

        $em->persist($user);
        $em->flush();

        return $this->render('index.html.twig', [
            'title' => 'Connection' . $user->getPseudo() . ', connectez-vous !'
        ]);
    }
}
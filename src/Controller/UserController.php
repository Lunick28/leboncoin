<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use App\Security\LoginFromAuthenticator;


class UserController extends AbstractController
{

    /**
     * @Route("/inscription_en_cours", name="inscription_en_cours")
     **/
    public function inscription(EntityManagerInterface $em, Request $request, UserPasswordEncoderInterface $passwordEncoder)
    {
        $user = new User();

        $user->setUsername($request->get('username'))
            ->setPassword($passwordEncoder->encodePassword(
                $user,
                $request->get('password')
            ));


        $em->persist($user);
        $em->flush();

        return $this->render('index.html.twig', [
            'title' => 'Bienvenue au gadjo ' . $user->getUsername() . ', installe toi au bar et connecte toi avec l\'Didier !'
        ]);
    }

    /**
     * @Route("/all_users", name="all_users")
     **/
    public function list(EntityManagerInterface $em)
    {
        $repository = $em ->getRepository(User::class);
        $e = 'aucune erreur';

        $users = $repository->findAllUser();

        if(!$users) {
            $e = 'aucun utilisateur trouvé !';
        }

        return $this->render('bdd.html.twig', [
            "users" => $users,
            "erreur" => $e,
            "title" => 'Tout les utilisateurs'
        ]);
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

    /**
     * @Route("/user/{username}", name="user")
     **/
    public function user(EntityManagerInterface $em, Request $request, $username)
    {
        $repository = $this->getDoctrine()->getRepository(User::class);
        $user = $repository->findOneBy(['username' => $username]);

        return $this->render('user.html.twig', [
            'user' => $user
        ]);
    }

    /**
 * @Route("/monprofil", name="monprofil")
 **/
    public function monprofil(EntityManagerInterface $em, Request $request)
    {
        if($this->getUser() === NULL) {
            return $this->render('index.html.twig', [
                'username' => 'Une erreur est survenue, reconnectez-vous !',
                'title' => ''
            ]);
        }
        else {
            return $this->render('monprofil.html.twig', [
                'user' => $this->getUser()
            ]);
        }
    }

    /**
     * @Route("/editprofile", name="editprofile")
     **/
    public function editprofile(EntityManagerInterface $em, Request $request)
    {
        if($this->getUser() === NULL) {
            return $this->render('index.html.twig', [
                'username' => 'Une erreur est survenue, reconnectez-vous !',
                'title' => ''
            ]);
        }
        else {
            return $this->render('editprofile.html.twig', [
                'user' => $this->getUser()
            ]);
        }
    }

    /**
     * @Route("/saveprofile", name="saveprofile")
     **/
    public function saveprofile(EntityManagerInterface $em, Request $request, UserPasswordEncoderInterface $passwordEncoder)
    {
        if($this->getUser() === NULL) {
            return $this->render('index.html.twig', [
                'username' => 'Une erreur est survenue, reconnectez-vous !',
                'title' => ''
            ]);
        }
        else {
            $this->getUser()->setUsername($request->get('username'))
                ->setPassword($passwordEncoder->encodePassword(
                    $this->getUser(),
                    $request->get('password')
                ));


            $em->persist($this->getUser());
            $em->flush();

            return $this->render('index.html.twig', [
                'username' => $this->getUser()->getUsername(),
                'title' => 'Le mot de passe et l\'identifiant ont été mis à jour !'
            ]);
        }
    }

}
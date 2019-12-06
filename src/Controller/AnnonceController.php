<?php

namespace App\Controller;

use App\Entity\Annonce;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use App\Security\LoginFromAuthenticator;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;

class AnnonceController extends AbstractController
{
    /**
     * @Route("/annonces", name="annonces")
     **/
    public function annonces() {

        $repository = $this->getDoctrine()->getRepository(Annonce::class);
        $annonces = $repository->findAll();

        return $this->render('annonces.html.twig', [
            'username' => $this->getUser()->getUsername(),
            'annonces' => $annonces
        ]);
    }

    /**
     * @Route("/creationAnnonces", name="creationAnnonces")
     **/
    public function creationAnnonces() {
        return $this->render('creationAnnonces.html.twig', [
            'username' => $this->getUser()->getUsername()
        ]);
    }

    /**
     * @Route("/createAnnonce", name="createAnnonce")
     **/
    public function createAnnonce(EntityManagerInterface $em, Request $request) {
        $annonce = new Annonce();

        $annonce->setName($request->get('name'))
            ->setPrice($request->get('price'))
            ->setDescription($request->get('description'))
            ->setCategory($request->get('category'))
            ->setUser($this->getUser())
        ;

        $this->getUser()->addAnnonce($annonce);

        $em->persist($annonce);
        $em->flush();

        return $this->redirectToRoute('annonces');
    }

    /**
     * @Route("/annonce/{category}", name="annonce")
     **/
    public function category(EntityManagerInterface $em, Request $request, $category)
    {
        $repository = $this->getDoctrine()->getRepository(Annonce::class);
        $annonceName = $category;
        $category = $repository->findBy(['category' => $category]);

        return $this->render('category.html.twig', [
            'annonces' => $category,
            'annonceName' => $annonceName
        ]);
    }

    /**
     * @Route("/editannonce/{annonce}", name="editannonce")
     **/
    public function editannonce(EntityManagerInterface $em, Request $request, $annonce)
    {
        $repository = $this->getDoctrine()->getRepository(Annonce::class);
        $a = $repository->findOneBy(['id' => $annonce]);

        return $this->render('editannonce.html.twig', [
            'annonce' => $a
        ]);
    }

    /**
     * @Route("/saveannonce/{annonce}", name="saveannonce")
     **/
    public function saveannonce(EntityManagerInterface $em, Request $request, $annonce)
    {
        $repository = $this->getDoctrine()->getRepository(Annonce::class);
        $a = $repository->findOneBy(['id' => $annonce]);

        $a->setName($request->get('name'))
            ->setPrice($request->get('price'))
            ->setDescription($request->get('description'))
            ->setCategory($request->get('category'))
        ;

        $em->persist($a);
        $em->flush();

        return $this->redirectToRoute('monprofil');
    }

    /**
     * @Route("/deleteannonce/{annonce}", name="deleteannonce")
     **/
    public function deleteannonce(EntityManagerInterface $em, Request $request, $annonce)
    {
        $repository = $this->getDoctrine()->getRepository(Annonce::class);
        $a = $repository->findOneBy(['id' => $annonce]);

        $em->remove($a);
        $em->flush();

        return $this->redirectToRoute('monprofil');
    }

}
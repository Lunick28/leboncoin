<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\Json;
use App\Entity\Annonce;


class ApiController extends AbstractController
{
    /**
     * @Route("/api/getallannonces", name="api_getallannonces")
     **/
    public function getallannonces() {
        $encoder = [new XmlEncoder(), new JsonEncoder()];
        $normalizers = [new ObjectNormalizer()];

        $serializer = new Serializer($normalizers, $encoder);

        $repository = $this->getDoctrine()->getRepository(Annonce::class);
        $annonces = $repository->findAll();

        $jsonContent = $serializer->serialize($annonces, 'json', [AbstractNormalizer::IGNORED_ATTRIBUTES => ['user']]);

        return new JsonResponse($jsonContent);
    }
}
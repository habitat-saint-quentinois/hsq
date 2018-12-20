<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Push;
use App\Entity\Property;

class IndexController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index()
    {
        $repository = $this->getDoctrine()->getRepository(Property::class);
        $properties = $repository->findBy(['isActive' => 1, 'type' => 'location', 'push' => '1'] , ['place' => 'ASC'], 3);
        $repository = $this->getDoctrine()->getRepository(Push::class);
        $pushs = $repository->findBy(['isActive' => 1], ['place' => 'ASC'], 3);
        return $this->render('index/index.html.twig', [
            'pushs' => $pushs,
            'properties' => $properties,
        ]);
    }
}

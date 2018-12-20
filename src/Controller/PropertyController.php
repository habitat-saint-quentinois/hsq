<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Property;

class PropertyController extends AbstractController
{
    /**
     * @Route("/nos-biens-en-location", name="rental-list")
     */
    public function rental()
    {
        $repository = $this->getDoctrine()->getRepository(Property::class);
        $properties = $repository->findBy(['isActive' => 1, 'type' => 'location'] , ['place' => 'ASC']);
        return $this->render('property/listing.html.twig', [
            'properties' => $properties,
            'type' => 'location'
        ]);
    }

    /**
     * @Route("/nos-biens-en-vente", name="sell-list")
     */
    public function sell()
    {
        $repository = $this->getDoctrine()->getRepository(Property::class);
        $properties = $repository->findBy(['isActive' => 1, 'type' => 'vente'] , ['place' => 'ASC']);
        return $this->render('property/listing.html.twig', [
            'properties' => $properties,
            'type' => 'vente'
        ]);
    }

    /**
     * @Route("/logement/{slug}", name="property")
     */
    public function index(string $slug)
    {
        $repository = $this->getDoctrine()->getRepository(Property::class);
        $property = $repository->findOneBySlug($slug);
        return $this->render('property/index.html.twig', [
            'property' => $property,
        ]);
    }
}

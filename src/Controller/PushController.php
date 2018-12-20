<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Push;

class PushController extends AbstractController
{
    /**
     * @Route("/toutes-nos-news", name="push")
     */
    public function index()
    {
        $repository = $this->getDoctrine()->getRepository(Push::class);
        $pushs = $repository->findBy(['isActive' => 1], ['createdAt' => 'DESC']);
        return $this->render('push/index.html.twig', [
            'pushs' => $pushs,
        ]);
    }
}

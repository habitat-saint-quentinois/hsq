<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Page;

class PageController extends AbstractController
{
    /**
     * @Route("/page/{slug}", name="page")
     */
    public function index(string $slug)
    {
        $repository = $this->getDoctrine()->getRepository(Page::class);
        $page = $repository->findOneBySlug($slug);
        return $this->render('page/index.html.twig', [
            'page' => $page,
        ]);
    }
}

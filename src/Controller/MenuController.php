<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\MenuElement;
use Symfony\Component\HttpFoundation\Response;

class MenuController extends AbstractController
{
    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function main(): Response
    {
        $repository = $this->getDoctrine()->getRepository(MenuElement::class);
        $elements = $repository->findByLevel(1);
        return $this->render('menu/main.html.twig', ['elements' => $elements]);
    }

    /**
     * @param int $pageId
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function side(int $pageId): Response
    {
        $repository = $this->getDoctrine()->getRepository(MenuElement::class);
        $element = $repository->findTopByPage($pageId);
        return $this->render('menu/side.html.twig', ['element' => $element, 'pageId' => $pageId]);
    }
}

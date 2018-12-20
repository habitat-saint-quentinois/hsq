<?php

namespace App\Controller;

use App\Entity\Config;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class BlockController extends AbstractController
{
    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function footer(): Response
    {
        $repository = $this->getDoctrine()->getRepository(Config::class);
        return $this->render('block/footer.html.twig', ['config' => $repository->getConfig()]);
    }
}

<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Document;

class DownloadController extends AbstractController
{
    /**
     * @Route("/documents-a-telecharger", name="download")
     */
    public function index()
    {
        $repository = $this->getDoctrine()->getRepository(Document::class);
        $documents = $repository->findBy(['isActive' => 1] , ['createdAt' => 'DESC']);
        return $this->render('download/index.html.twig', [
            'documents' => $documents
        ]);
    }
}

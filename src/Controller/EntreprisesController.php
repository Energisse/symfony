<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EntreprisesController extends AbstractController
{
    /**
     * @Route("/entreprises", name="entreprises")
     */
    public function index(): Response
    {
        return $this->render('entreprises/index.html.twig', [
            'controller_name' => 'EntreprisesController',
        ]);
    }
}

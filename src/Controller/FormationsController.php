<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FormationsController extends AbstractController
{
    /**
     * @Route("/formations", name="formations")
     */
    public function index(): Response
    {
        return $this->render('formations/index.html.twig', [
            'controller_name' => 'FormationsController',
        ]);
    }
}

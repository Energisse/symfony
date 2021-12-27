<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProStageController extends AbstractController
{
    /**
     * @Route("/", name="pro_stage")
     */
    public function index(): Response
    {
        return $this->render('pro_stage/index.html.twig');
    }

    /**
     * @Route("/entreprises", name="entreprises")
     */
    public function afficherEntreprises(): Response
    {
        return $this->render('pro_stage.html.twig');
    }

    /**
     * @Route("/formations", name="formations")
     */
    public function afficherFormations(): Response
    {
        return $this->render('pro_stage/formations.html.twig');
    }

    /**
     * @Route("/stages/{id}", name="stages")
     */
    public function afficherStages($id): Response
    {
        return $this->render('pro_stage/stages.html.twig', [
            'id' => $id,
        ]);
    }
}

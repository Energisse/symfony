<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\EntrepriseRepository;
use App\Repository\FormationRepository;
use App\Repository\StageRepository;

class ProStageController extends AbstractController
{
    /**
     * @Route("/entreprises", name="entreprises")
     */
    public function afficherEntreprises(EntrepriseRepository $repositoryEntreprise): Response
    {
        $entreprises = $repositoryEntreprise->findAll();
        return $this->render('pro_stage/entreprises.html.twig',["entreprises"=>$entreprises]);
    }

    /**
     * @Route("/entreprise/{id}", name="stages-entreprise")
     */
    public function afficherStagesEntreprise(EntrepriseRepository $repositoryEntreprise,$id): Response
    {
        $entreprise = $repositoryEntreprise->find($id);

        return $this->render('pro_stage/stages-entreprise.html.twig',["entreprise"=>$entreprise]);
    }

    /**
     * @Route("/formations", name="formations")
     */
    public function afficherFormations(FormationRepository $repositoryFormation): Response
    {
        $formations = $repositoryFormation->findAll();

        return $this->render('pro_stage/formations.html.twig',["formations" => $formations]);
    }

    /**
     * @Route("/formation/{id}", name="stages-formation")
     */
    public function afficherStagesFormation(FormationRepository $repositoryFormation,$id): Response
    {
        $formation = $repositoryFormation->find($id);

        return $this->render('pro_stage/stages-formation.html.twig',["formation" => $formation]);
    }

    /**
     * @Route("/", name="stages")
     */
    public function afficherStages(StageRepository $repositoryStage): Response
    {   
        $stages = $repositoryStage->findAll();
     
        return $this->render('pro_stage/stages.html.twig',["stages"=>$stages]);
    }

    /**
     * @Route("/stages/{id}", name="stage")
     */
    public function afficherStage(StageRepository $repositoryStage,$id): Response
    {   
        $stage = $repositoryStage->find($id);

        return $this->render('pro_stage/stage.html.twig', [
            'stage' => $stage,
        ]);
    }
}

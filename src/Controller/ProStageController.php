<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\EntrepriseRepository;
use App\Repository\StageRepository;
use App\Entity\Entreprise;
use App\Entity\Stage;
use App\Repository\FormationRepository; 
use App\Form\EntrepriseType;
use App\Form\StageType;

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
     * @Route("/entreprise/{nom}", name="stages-entreprise")
     */
    public function afficherStagesEntreprise(StageRepository $repositoryStage,$nom): Response
    {
        $stages = $repositoryStage->findAllStagesByEntreprise($nom);
        return $this->render('pro_stage/stages-entreprise.html.twig',[
                                                                "stages"=>$stages,
                                                                "nomEntreprise"=>$nom
                                                            ]);
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
     * @Route("/formation/{nom}", name="stages-formation")
     */
    public function afficherStagesFormation(StageRepository $repositoryStage,$nom): Response
    {
        $stages = $repositoryStage->findAllStagesByFormation($nom);
        return $this->render('pro_stage/stages-formation.html.twig',[
                                                                "stages"=>$stages,
                                                                "nomFormation"=>$nom
                                                            ]);
    }

    /**
     * @Route("/", name="stages")
     */
    public function afficherStages(StageRepository $repositoryStage): Response
    {   
        $stages = $repositoryStage->findAll();
     
        return $this->render('pro_stage/stages.html.twig',["stages"=>$stages,"titre"=>"Liste des stages"]);
    }

    /**
     * @Route("/stage/{id}", name="stage")
     */
    public function afficherStage(StageRepository $repositoryStage,$id): Response
    {   
        $stage = $repositoryStage->find($id);

        return $this->render('pro_stage/stage.html.twig', [
            'stage' => $stage,
        ]);
    }

    /**
     * @Route("/ajout-entreprise", name="ajout-entreprise")
     */
    public function afficherFormAjoutEntreprise(Request $request,EntityManagerInterface $entityManager): Response
    {   
        $entreprise = new Entreprise();

        $formulaire = $this->createForm(EntrepriseType::class,$entreprise);

        $formulaire->handleRequest($request);

        if($formulaire->isSubmitted() && $formulaire->isValid()){
            $entreprise = $formulaire->getData();
            
            $entityManager->persist($entreprise);
            $entityManager->flush();
            return $this->redirectToRoute("entreprises");

        }


        return $this->render('pro_stage/ajout-entreprise.html.twig', [
            'formulaire' => $formulaire->createView(),
        ]);
    }

    /**
     * @Route("/modification-entreprise/{id}", name="modification-entreprise")
     */
    public function afficherFormModificationEntreprise(Request $request,EntityManagerInterface $entityManager,EntrepriseRepository $repositoryEntreprise,$id): Response
    {   
        $entreprise = $repositoryEntreprise->find($id);

        $formulaire = $this->createForm(EntrepriseType::class,$entreprise);

        $formulaire->handleRequest($request);
        if($formulaire->isSubmitted() && $formulaire->isValid()){
            $entreprise = $formulaire->getData();
            
            $entityManager->persist($entreprise);
            $entityManager->flush();
            return $this->redirectToRoute("entreprises");
        }


        return $this->render('pro_stage/modification-entreprise.html.twig', [
            'formulaire' => $formulaire->createView(),
        ]);
    }

    /**
     * @Route("/ajout-stage", name="ajout-stage")
     */
    public function afficherFormAjoutStage(Request $request,EntityManagerInterface $entityManager): Response
    {   
        $stage = new Stage();

        $formulaire = $this->createForm(StageType::class,$stage);

        $formulaire->handleRequest($request);
        if($formulaire->isSubmitted() && $formulaire->isValid()){
            $stage = $formulaire->getData();
            
            $entityManager->persist($stage);
            $entityManager->persist($stage->getEntreprise());
            $entityManager->flush();
            return $this->redirectToRoute("stages");
        }


        return $this->render('pro_stage/ajout-stage.html.twig', [
            'formulaire' => $formulaire->createView(),
        ]);
    }



    
}

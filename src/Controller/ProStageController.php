<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\EntrepriseRepository;
use App\Entity\Entreprise;
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
     * @Route("/entreprise/{nom}", name="stages-entreprise")
     */
    public function afficherStagesEntreprise(EntrepriseRepository $repositoryEntreprise,$nom): Response
    {
        $entreprise = $repositoryEntreprise->findAllStagesByEntreprise($nom);
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
     * @Route("/formation/{nom}", name="stages-formation")
     */
    public function afficherStagesFormation(FormationRepository $repositoryFormation,$nom): Response
    {
        $formation = $repositoryFormation->findAllStagesByFormation($nom);

        return $this->render('pro_stage/stages-formation.html.twig',["formation"=>$formation]);
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

        $formulaire = $this->createFormBuilder($entreprise)
                           ->add("activite")
                           ->add("adresse")
                           ->add("nom")
                           ->add("URLsite")
                           ->getForm();

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

        $formulaire = $this->createFormBuilder($entreprise)
                           ->add("activite")
                           ->add("adresse")
                           ->add("nom")
                           ->add("URLsite")
                           ->getForm();

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
}

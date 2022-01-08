<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Entreprise;
use App\Entity\Formation;
use App\Entity\Stage;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        //création du générateur données faker
        $faker = \Faker\Factory::create('fr_FR');

        $nombreEntreprise = 10;
        $entreprises = array();
        for ( $i = 0; $i <= $nombreEntreprise; $i++){
            //creation d'un entreprise
            $entreprise = new Entreprise();

            $nom = $faker->name;
            $entreprise->setActivite($faker->realText($maxNbChars = 50, $indexSize = 2));
            $entreprise->setAdresse($faker->address);
            $entreprise->setNom($nom);
            $entreprise->setURLsite("https://".$faker->domainName);
            // $entreprise->setURLsite($faker->url);

            array_push($entreprises,$entreprise);
            $manager->persist($entreprise);
        }

        $nombreFormation = 10;
        $formations = array();
        for ( $i = 0; $i <= $nombreFormation; $i++){
            //creation d'une Formation
            $formation = new Formation();      
            
            $formation->setNomLong($faker->realText($maxNbChars = 50, $indexSize = 2));
            $formation->setNomCourt($faker->realText($maxNbChars = 20, $indexSize = 2));
            array_push($formations,$formation);
            $manager->persist($formation);
        }

        $nombreStage = 100;
        for ( $i = 0; $i <= $nombreStage; $i++){
            //creation d'un stage
            $stage = new Stage();                  
            $stage->setTitre($faker->realText($maxNbChars = 50, $indexSize = 2));
            $stage->setDescMissions($faker->realText($maxNbChars = 200, $indexSize = 2));
            $stage->setEmailContact($faker->email);
            $codeEntreprise = $faker->numberBetween($min = 0, $max = $nombreEntreprise);
            $stage->setEntreprise($entreprises[$codeEntreprise]);
            $nombreFormationStage =  $faker->numberBetween($min = 1, $max = 5);
            for( $indice = 0; $indice <= $nombreFormationStage; $indice++){
                $codeFormation = $faker->numberBetween($min = 0, $max = $nombreFormation);
                $stage->addformations($formations[$codeFormation]);
            }
            $manager->persist($stage);
        }

        $manager->flush();
    }
}

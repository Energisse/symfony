<?php

namespace App\Repository;

use App\Entity\Stage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Stage|null find($id, $lockMode = null, $lockVersion = null)
 * @method Stage|null findOneBy(array $criteria, array $orderBy = null)
 * @method Stage[]    findAll()
 * @method Stage[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StageRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Stage::class);
    }

    public function findAllStagesByEntreprise($nom){
        return $this->createQueryBuilder('s')
                    ->select('s,e')
                    ->join('s.entreprise','e')
                    ->andWhere('e.nom = :nomEntreprise')
                    ->setParameter('nomEntreprise', $nom)
                    ->getQuery()
                    ->getResult();
    }

    public function findAllStagesByFormation($nom){
        $gesionnaireEntity = $this->getEntityManager();

        return $gesionnaireEntity->createQuery('SELECT s,e
                                            FROM App\Entity\Stage s
                                            JOIN s.entreprise e
                                            JOIN s.formations f
                                            WHERE f.nomLong = :nomFormation')
                                    ->setParameters(array(
                                        'nomFormation' => $nom
                                    ))
                                    ->execute();
    
    }

    // /**
    //  * @return Stage[] Returns an array of Stage objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Stage
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

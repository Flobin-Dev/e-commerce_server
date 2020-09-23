<?php

namespace App\Repository;

use App\Entity\SpecDefinition;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method SpecDefinition|null find($id, $lockMode = null, $lockVersion = null)
 * @method SpecDefinition|null findOneBy(array $criteria, array $orderBy = null)
 * @method SpecDefinition[]    findAll()
 * @method SpecDefinition[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SpecDefinitionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SpecDefinition::class);
    }

    // /**
    //  * @return SpecDefinition[] Returns an array of SpecDefinition objects
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
    public function findOneBySomeField($value): ?SpecDefinition
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

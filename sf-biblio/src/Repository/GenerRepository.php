<?php

namespace App\Repository;

use App\Entity\Gener;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Gener|null find($id, $lockMode = null, $lockVersion = null)
 * @method Gener|null findOneBy(array $criteria, array $orderBy = null)
 * @method Gener[]    findAll()
 * @method Gener[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GenerRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Gener::class);
    }

    // /**
    //  * @return Gener[] Returns an array of Gener objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('g.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Gener
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

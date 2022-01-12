<?php

namespace App\Repository;

use App\Entity\Annances;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Annances|null find($id, $lockMode = null, $lockVersion = null)
 * @method Annances|null findOneBy(array $criteria, array $orderBy = null)
 * @method Annances[]    findAll()
 * @method Annances[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AnnancesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Annances::class);
    }

    // /**
    //  * @return Annances[] Returns an array of Annances objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Annances
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

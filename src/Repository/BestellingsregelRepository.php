<?php

namespace App\Repository;

use App\Entity\Bestellingsregel;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Bestellingsregel|null find($id, $lockMode = null, $lockVersion = null)
 * @method Bestellingsregel|null findOneBy(array $criteria, array $orderBy = null)
 * @method Bestellingsregel[]    findAll()
 * @method Bestellingsregel[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BestellingsregelRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Bestellingsregel::class);
    }

    // /**
    //  * @return Bestellingsregel[] Returns an array of Bestellingsregel objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('b.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Bestellingsregel
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

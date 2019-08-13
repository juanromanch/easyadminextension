<?php

namespace App\Repository;

use App\Entity\Represen;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Represen|null find($id, $lockMode = null, $lockVersion = null)
 * @method Represen|null findOneBy(array $criteria, array $orderBy = null)
 * @method Represen[]    findAll()
 * @method Represen[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RepresenRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Represen::class);
    }

    // /**
    //  * @return Represen[] Returns an array of Represen objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Represen
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

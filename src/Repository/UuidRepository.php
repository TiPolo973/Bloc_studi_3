<?php

namespace App\Repository;

use App\Entity\Uuid;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Uuid>
 *
 * @method Uuid|null find($id, $lockMode = null, $lockVersion = null)
 * @method Uuid|null findOneBy(array $criteria, array $orderBy = null)
 * @method Uuid[]    findAll()
 * @method Uuid[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UuidRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Uuid::class);
    }

    //    /**
    //     * @return Uuid[] Returns an array of Uuid objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('u')
    //            ->andWhere('u.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('u.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Uuid
    //    {
    //        return $this->createQueryBuilder('u')
    //            ->andWhere('u.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}

<?php

namespace App\Repository;

use App\Entity\SegmentGroup;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method SegmentGroup|null find($id, $lockMode = null, $lockVersion = null)
 * @method SegmentGroup|null findOneBy(array $criteria, array $orderBy = null)
 * @method SegmentGroup[]    findAll()
 * @method SegmentGroup[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SegmentGroupRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SegmentGroup::class);
    }

    // /**
    //  * @return SegmentGroup[] Returns an array of SegmentGroup objects
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
    public function findOneBySomeField($value): ?SegmentGroup
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

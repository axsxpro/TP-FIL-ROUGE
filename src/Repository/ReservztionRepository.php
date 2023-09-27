<?php

namespace App\Repository;

use App\Entity\Reservztion;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Reservztion>
 *
 * @method Reservztion|null find($id, $lockMode = null, $lockVersion = null)
 * @method Reservztion|null findOneBy(array $criteria, array $orderBy = null)
 * @method Reservztion[]    findAll()
 * @method Reservztion[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ReservztionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Reservztion::class);
    }

//    /**
//     * @return Reservztion[] Returns an array of Reservztion objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('r.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Reservztion
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}

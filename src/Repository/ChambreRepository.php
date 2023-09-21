<?php

namespace App\Repository;

use App\Entity\Chambre;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Chambre>
 *
 * @method Chambre|null find($id, $lockMode = null, $lockVersion = null)
 * @method Chambre|null findOneBy(array $criteria, array $orderBy = null)
 * @method Chambre[]    findAll()
 * @method Chambre[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ChambreRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Chambre::class);
    }

   /**
    * @return Chambre[] Returns an array of Chambre objects
    */
//    public function findByOneDonnes(): array
//    {
//        return $this->createQueryBuilder('c')
//        ->select('c', 'u', 'r')
//        ->leftJoin('c.reservation', 'r')
//        ->leftJoin('r', 'u')
//        ->andWhere('r.DateReservation = :date')
//        ->setParameter('date', new \DateTime())
//        ->orderBy('c.id', 'ASC')
//        ->setMaxResults(10)
//        ->getQuery()
//        ->getResult()
//        ;
//    }
//    public function findOneByRoom()
//    {
//        return $this->createQueryBuilder('c')
//        ->select('c','rc','r','u')
//        ->leftJoin('c.reservationChambres', 'rc')
//         ->leftJoin('rc.reservation', 'r')
//         ->leftJoin('r.user', 'u')
//         ->andWhere('c.tarif = :occupee')
//         ->setParameter('occupee', false)
//         ->getQuery()
//         ->getSingleScalarResult()()
//        ;}

//    public function findOneBySomeField($value): ?Chambre
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}

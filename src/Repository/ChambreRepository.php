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
  public function findEmptyRooms()
   {
       return $this->createQueryBuilder('c')
           ->andWhere('c.etat =:libre')
           ->setParameter('libre', true)
           ->getQuery()
           ->getResult()
       ;}

        /**
     * @return Chambre[] Returns an array of Chambre objects
   */

       public function findOneByRoom()
   {
       return $this->createQueryBuilder('c')
       ->select('c','rc','r','u')
       ->leftJoin('c.reservationChambres', 'rc')
        ->leftJoin('rc.reservation', 'r')
        ->leftJoin('r.user', 'u')
        ->andWhere('c.etat = :occupee')
        ->setParameter('occupee', false)
        ->getQuery()
        ->getResult()
       ;}

// public function findcountChambre(): int
// {
//     return $this->createQueryBuilder('c')
//         ->select('COUNT(c.id)') 
//         ->getQuery()
//         ->getSingleScalarResult(); 
// }



//     public function findcountReservation(): int
// {
//     return $this->createQueryBuilder('rc')
//         ->select('COUNT(rc.id)') 
//         ->getQuery()
//         ->getSingleScalarResult(); 
// }

//    /**
//     * @return Chambre[] Returns an array of Chambre objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('c.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

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
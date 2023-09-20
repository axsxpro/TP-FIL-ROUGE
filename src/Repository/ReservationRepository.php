<?php

namespace App\Repository;

use App\Entity\Reservation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use DateTime;
/**
 * @extends ServiceEntityRepository<Reservation>
 *
 * @method Reservation|null find($id, $lockMode = null, $lockVersion = null)
 * @method Reservation|null findOneBy(array $criteria, array $orderBy = null)
 * @method Reservation[]    findAll()
 * @method Reservation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ReservationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Reservation::class);
    }

//     public function findReservationsByUser(): array
// {
//     return $this->createQueryBuilder('r')
//         ->leftJoin('r.user', 'u') // Jointure avec la table User
//         ->select(['u.id as userId', 'r']) // Sélectionnez l'ID de l'utilisateur
//         ->getQuery()
//         ->getResult();
// }

   /**
    * @return Reservation[] Returns an array of Reservation objects
    */

public function findcountReservation(): int
{
    return $this->createQueryBuilder('rc')
        ->select('COUNT(rc.id)') 
        ->getQuery()
        ->getSingleScalarResult(); 
}


public function findChambreByReservation(Reservation $reservation)
    {
        return $this->createQueryBuilder('r')
            ->select('c')
            ->join('r.reservationChambres', 'rc')
            ->join('rc.chambre', 'c')
            ->where('r.id = :reservationId')
            ->setParameter('reservationId', $reservation->getId())
            ->getQuery()
            ->getResult();
    }


    

}

//afficher les reservations futures
    //   public function findcountReservation(): int
// {
//     $count = $this->createQueryBuilder('rc')
//         ->select('COUNT(rc.id)') 
//         ->andWhere('rc.dateReservation >= :now')
//         ->setParameter('now', new DateTime())
//         ->getQuery()
//         ->getSingleScalarResult();

//     return $count;
// }

//Avec cette modification, votre méthode findcountReservation renverra directement le nombre de réservations en tant qu'entier sans utiliser count(). Assurez-vous également d'appeler cette méthode correctement dans votre contrôleur, comme je l'ai mentionné précédemment.

//    public function findOneBySomeField($value): ?Reservation
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
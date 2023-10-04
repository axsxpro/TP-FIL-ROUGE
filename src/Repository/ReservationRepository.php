<?php

namespace App\Repository;

use App\Entity\Reservation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

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


    // public function findReservationsByUser(): array
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


    // public function findChambreByReservation(Reservation $reservation)
    // {
    //     return $this->createQueryBuilder('r')
    //         ->select('c')
    //         ->join('r.reservationChambres', 'rc')
    //         ->join('rc.chambre', 'c')
    //         ->where('r.id = :reservationId')
    //         ->setParameter('reservationId', $reservation->getId())
    //         ->getQuery()
    //         ->getResult();
    // }



    public function findAllReservation($reservationId)
{
    return $this->createQueryBuilder('r')
        ->select('r', 'u', 'c')
        ->leftJoin('r.chambre', 'c')
        ->leftJoin('r.user', 'u')
        ->andWhere('c.etat = :etat')
        ->andWhere('r.id = :reservationId') 
        ->setParameter('etat', false)
        ->setParameter('reservationId', $reservationId) 
        ->getQuery()
        ->getScalarResult();
}


public function findReservationWithChambre()
{
    return $this->createQueryBuilder('r')
        ->select('r', 'u', 'c')
        ->leftJoin('r.chambre', 'c')
        ->leftJoin('r.user', 'u')
        ->andWhere('c.etat = :etat')
        ->setParameter('etat', false)
        // ->andWhere('r.id = :reservationId')
        // ->setParameter('reservationId', $reservationId)
        ->getQuery()
        ->getScalarResult();
}


}

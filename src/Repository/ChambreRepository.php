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


    public function afficherChambreLibre($etat)
    {
        // Utilisation du QueryBuilder pour créer une requête SQL
        return $this->createQueryBuilder('chambre') // Alias de la table 'Categorie' nommé aussi 'categorie'
            ->select('chambre.etat') //Sélectionne uniquement la colonne 'etat', equivaut à : SELECT etat from chambre
            ->where('chambre.etat = :libre') // condition where, equivaut à : where libelle = :libelle(parametre/valeur)
            ->setParameter('libre', $etat)  // Lie la valeur true au paramètre :libre('libre')
            ->getQuery(); // Obtient l'objet de requête
        //->getScalarResult();
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
            ->getResult();
    }

    /**
     * @return Chambre[] Returns an array of Chambre objects
     */


    public function findOneByRoom()
    {

        return $this->createQueryBuilder('c')
            ->select('c', 'rc', 'r', 'u') // Sélectionnez les alias c, rc, r et u
            ->leftJoin('c.reservationChambres', 'rc')
            ->leftJoin('rc.reservation', 'r')
            ->leftJoin('r.user', 'u')
            ->andWhere('c.etat = :occupee')
            ->setParameter('occupee', false) // Changer false en true pour trouver les chambres occupées
            ->getQuery()
            ->getResult(); // Utilisez getResult() au lieu de getScalarResult()
    }


    /**
     * @return Chambre[] Returns an array of Chambre objects
     */

    public function findOneByChiffre()
    {
        return $this->createQueryBuilder('c')
            ->select('SUM(c.tarif) as chiffre')
            ->leftJoin('c.reservationChambres', 'rc')
            ->leftJoin('rc.reservation', 'r')
            ->where('r.DateEntree <= :dateActuelle')
            ->andWhere('r.DateSortie >= :dateActuelle')
            ->setParameter('dateActuelle', new \DateTime())
            ->getQuery()
            ->getResult();
    }


    public function calculateChiffreDaffaires(\DateTime $startDate, \DateTime $endDate)
    {
        $queryBuilder = $this->createQueryBuilder('c')
            ->select('SUM(c.tarif) as chiffre')
            ->leftJoin('c.reservationChambres', 'rc')
            ->leftJoin('rc.reservation', 'r')
            ->where('r.DateEntree <= :endDate')
            ->andWhere('r.DateSortie >= :startDate')
            ->setParameter('startDate', $startDate)
            ->setParameter('endDate', $endDate)
            ->getQuery();
    
        return $queryBuilder->getSingleScalarResult();
    }

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

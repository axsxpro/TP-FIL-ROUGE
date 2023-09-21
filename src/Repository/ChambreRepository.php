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
            // ->getSingleScalarResult(); // Exécute la requête et récupère un seul résultat scalaire 
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

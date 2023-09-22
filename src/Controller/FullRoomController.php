<?php

namespace App\Controller;

use App\Repository\ChambreRepository; // Importation du repository
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FullRoomController extends AbstractController
{
    #[Route('/chambreOcuppee', name: 'chambreOcuppee')] // Définition de la route
    public function index(ChambreRepository $chambreRepository): Response // Injection du repository ChambreRepository
    {
       
        // Utilisation du repository pour trouver une chambre en appelant la fonction dans le repository
        $fullRoom = $chambreRepository->findOneByRoom();
        
        // Utilisation de la fonction 'dd' pour afficher les données
        //dd($fullRoom);

    
        // Rendu de la vue avec les données
        return $this->render('chambre_occupee/index.html.twig', [
            
            'fullRoom' => $fullRoom,
           
        ]);
    }
}

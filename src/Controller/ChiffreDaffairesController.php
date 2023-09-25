<?php

namespace App\Controller;
use Symfony\Component\HttpFoundation\Request;
use App\Form\ChiffreDaffairesType;
// use App\Entity\Reservation;
use App\Repository\ChambreRepository;
// use App\Repository\ReservationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ChiffreDaffairesController extends AbstractController
{
    #[Route('/chiffre/daffaires', name: 'app_chiffre_daffaires')]
    public function index(Request $request, ChambreRepository $chambreRepository): Response
    {
        // Récupérez le chiffre d'affaires initial depuis le repository
        $chiffreDaffaire = $chambreRepository->findOneByChiffre();
        // dd($chiffreDaffaire);
        
        // Créez le formulaire en utilisant ChiffreDaffairesType
        $form = $this->createForm(ChiffreDaffairesType::class);

        // Gérez la soumission du formulaire
        $form->handleRequest($request);

        // Initialisez la variable $chiffreDaffaireForm à null
        $chiffreDaffaireForm = null;

        // Vérifiez si le formulaire a été soumis et est valide
        if ($form->isSubmitted() && $form->isValid()) {
            // Récupérez les dates sélectionnées à partir du formulaire
            $startDate = $form->get('dateEntree')->getData();
            $endDate = $form->get('dateSortie')->getData();

            // Utilisez les dates pour calculer le chiffre d'affaires
            $chiffreDaffaireForm = $chambreRepository->calculateChiffreDaffaires($startDate, $endDate);
            // dd($chiffreDaffaireForm);
        
        }
        // //choffre daffaire par mois
        // $chiffreDaffaireForMonths = $reservationRepository->calculateChiffreDaffairesByMonth();
        
        
        
        // Si le formulaire n'a pas encore été soumis, ou s'il n'est pas valide, affichez simplement le formulaire
        return $this->render('chiffre_daffaires/index.html.twig', [
            'form' => $form->createView(),
            'chiffreDaffaire' => $chiffreDaffaire, 
            'chiffreDaffaireForm' => $chiffreDaffaireForm,
            // 'chiffreDaffaireForMonths' => $chiffreDaffaireForMonths, 
        ]);
    }
}
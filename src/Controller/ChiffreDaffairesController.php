<?php

namespace App\Controller;

use App\Entity\Chambre;
use App\Repository\ChambreRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ChiffreDaffairesController extends AbstractController
{
    #[Route('/chiffre/daffaires', name: 'app_chiffre_daffaires')]
    public function index(ChambreRepository $chambreRepository): Response
    {




$chiffreDaffaire = $chambreRepository->findOneByChiffre();

// dd($chiffreDaffaire);

        return $this->render('chiffre_daffaires/index.html.twig', [
            'chiffreDaffaire' => $chiffreDaffaire,
        ]);
    }
}
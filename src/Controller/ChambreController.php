<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ChambreController extends AbstractController
{
    #[Route('/chambre', name: 'app_chambre')]
    public function index(): Response
    {
        return $this->render('chambre/index.html.twig', [
            'controller_name' => 'ChambreController',
        ]);
    }
    #[Route('/chambre/junior', name: 'app_chambre_junior')]
    public function junior(): Response
    {
        return $this->render('chambre/chambreJunior.html.twig', [
            'controller_name' => 'ChambreController',
        ]);
    }
    #[Route('/chambre/superieur', name: 'app_chambre_superieur')]
    public function superieur(): Response
    {
        return $this->render('chambre/chambreSuperieur.html.twig', [
            'controller_name' => 'ChambreController',
        ]);
    }
}


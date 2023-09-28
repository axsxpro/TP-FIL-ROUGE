<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ListeChambreController extends AbstractController
{
    #[Route('/liste/chambre', name: 'app_liste_chambre')]
    public function index(): Response
    {
        return $this->render('liste_chambre/index.html.twig', [
            'controller_name' => 'ListeChambreController',
        ]);
    }
}

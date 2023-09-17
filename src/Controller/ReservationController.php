<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ReservationRepository;

class ReservationController extends AbstractController
{
    private $reservationRepository;

    public function __construct(ReservationRepository $reservationRepository)
    {
        $this->reservationRepository = $reservationRepository;
    }

    #[Route('/user/reservations', name: 'user_reservations')]
    public function getUserReservations(): Response
    {
        // Récupérez l'utilisateur actuellement authentifié
        $user = $this->getUser();

        if (!$user) {
            // Gérez le cas où l'utilisateur n'est pas authentifié
            throw $this->createAccessDeniedException('Vous n\'êtes pas connecté.');
        }

        // Récupérez les réservations de l'utilisateur
        $reservations = $this->reservationRepository->findBy(['user' => $user]);

        return $this->render('reservation/index.html.twig', [
            'user' => $user,
            'reservations' => $reservations,
        ]);
    }
}
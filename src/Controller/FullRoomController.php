<?php

namespace App\Controller;
use \App\Repository\ChambreRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FullRoomController extends AbstractController
{
    #[Route('/full/room', name: 'app_full_room')]
    public function index(chambreRepository $chambreRepository): Response
    {


        $FullRoom = $chambreRepository->findOneByRoom();
        
       // dd($FullRoom);
        $nbrChambre = count($FullRoom);




        
        return $this->render('full_room/index.html.twig', [
            'FullRoom' => $FullRoom,
            'nbrChambre' => $nbrChambre,
        ]);
    }
}
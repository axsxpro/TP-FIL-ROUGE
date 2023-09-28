<?php

namespace App\Controller;

use App\Entity\Chambre;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Form\PaiementType;
use App\Repository\ChambreRepository;
use App\Repository\ReservationRepository;
use App\Repository\ReservztionRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Stripe\Checkout\Session;
use Stripe\Stripe;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;

class PaiementController extends AbstractController
{

    // Page paiement lors de la validation de la reservation et redirection vers la page confirmation
    #[Route('/paiement', name: 'app_paiement')]
    public function index(): Response
    {

        // Créez une instance du formulaire
        $form = $this->createForm(PaiementType::class);


        return $this->render('paiement/index.html.twig', [
            'form' => $form->createView(), // Creation du formulaire et le Passer le formulaire au template Twig
        ]);
    }


    #[Route('/order/create-session-stripe/{id}', name: 'payment_stripe')]
    public function stripeCheckout($id, UserRepository $userRepository, ChambreRepository $chambreRepository, ReservationRepository $reservationRepository, Chambre $chambre): RedirectResponse
    {

        // recupération de l'utilisateur connecté
        $user = $this->getUser();

        // rechercher les infos de l'utilisateur connecté
        $utilisateur = $userRepository->find($user);

        // recuperation de l'id de l'utilisateur (exemple: 130)
        $userid = $utilisateur->getId();

        // Récupérer la dernière réservations associées à l'utilisateur connecté
        $reservation = $reservationRepository->findBy(

            // on peut rechercher par plusieurs critéres : l'id de l'user, la dernière date de reservation, l'id de la chambre
            ['user' => $userid],
            ['DateReservation' => 'DESC'],
            ['chambre' => $id],
            1  // Limiter à une seule réservation  
        );

        // Affichage des réservations
        dd($reservation);

        // recupération de la chambre par son id
        $recuperationChambre = $chambreRepository->find($id);
        // dd($recuperationReservation);


        // condition: s'il n'y a pas de panier alors on redirige vers la page ma reservation
        if (!$recuperationChambre) {

            return $this->redirectToRoute('reservation');
        }


        $dataReservation = [

            'userid' => $utilisateur->getId(),
            'nom' => $utilisateur->getNom(),
            'prenom' => $utilisateur->getNom(),
            'email' => $utilisateur->getEmail(),
            'id' => $recuperationChambre->getId(),
            'libelle' => $recuperationChambre->getLibelle(),
            'prix' => $recuperationChambre->getTarif(),
        ];

        // dd($dataReservation);


        Stripe::setApiKey('sk_test_51Nut3CARtHX7JHLqBgb66JQich3hgjpgisYDpmXEv0pibc1tUKPBDchQgGBVmVMlSy1ZRbUmbysnzY858GZJkoPs00bRKLAAOu');

        $checkout_session = Session::create([
            'line_items' => [[
                // 'price' => 
                // // 'currency' => 'eur',
                // 'product_data' => [
                //     'name' => 
                // ]
            ]],
            // 'mode' => 'payment',
            // 'success_url' => $YOUR_DOMAIN . '/success.html',
            // 'cancel_url' => $YOUR_DOMAIN . '/cancel.html',
        ]);





        return $this->render('paiement/index.html.twig', [
            'form' => $form->createView(), // Creation du formulaire et le Passer le formulaire au template Twig
        ]);
    }






    // #[Route('/submit-paiement', name: 'submit_paiement', methods: ['POST'])]
    // public function submitPaiment(Request $request): Response
    // {
    //     $form = $this->createForm(PaiementType::class);

    //     $form->handleRequest($request);

    //     if ($form->isSubmitted() && $form->isValid()) {


    //         // Récupérez les données du formulaire
    //         $formData = $form->getData();

    //         // Créez un tableau associatif avec les données
    //         $data = [
    //             'name'         => 'John Doe',
    //             'address'      => 'USA',
    //             'mobileNumber' => '000000000',
    //             'email'        => 'john.doe@email.com',
    //             'date_entree'        => 'JJ/MM/AAAA',
    //             'date_sortie'        => 'JJ/MM/AAAA',
    //             'prix'        => '000 €',
    //         ];

    //         // // Créez un fichier CSV
    //         // $csv = Writer::createFromString('');
    //         // $csv->insertOne(array_keys($data));
    //         // $csv->insertOne(array_values($data));

    //         // // Enregistrez le fichier CSV sur le serveur
    //         // $csvFileName = 'payment_' . date('YmdHis') . '.csv';
    //         // $csvFilePath = $this->getParameter('kernel.project_dir') . '/public/csv/' . $csvFileName;
    //         // $csv->output($csvFilePath);

    //         // Redirigez vers la route de confirmation
    //         return $this->redirectToRoute('app_confirmation');
    //     }

    //     return $this->render('paiement/index.html.twig', [
    //         'form' => $form->createView(),
    //     ]);
    // }




    // telechargement du PDF
    #[Route('/download-pdf', name: 'download_pdf')]
    public function downloadPdf(): Response
    {
        // Générez le PDF ici (vous pouvez utiliser une bibliothèque comme TCPDF ou mPDF)
        $pdfContent = 'Contenu du PDF à générer';

        // Créez une réponse pour le PDF
        $response = new Response($pdfContent);

        $disposition = $response->headers->makeDisposition(
            ResponseHeaderBag::DISPOSITION_ATTACHMENT,
            'compte_rendu.pdf'
        );
        $response->headers->set('Content-Disposition', $disposition);

        return $response;
    }
}

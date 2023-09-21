<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Form\PaiementType;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;

class PaiementController extends AbstractController
{
    #[Route('/paiement', name: 'app_paiement')]
    public function index(): Response
    {
        // Créez une instance du formulaire
        $form = $this->createForm(PaiementType::class);

        return $this->render('paiement/index.html.twig', [
            'controller_name' => 'PaiementController',
            'form' => $form->createView(), // Passez le formulaire au template Twig
        ]);
    }

   
#[Route('/submit-paiement', name: 'submit_paiement', methods: ['POST'])]
public function submitPaiment(Request $request): Response
{
    $form = $this->createForm(PaiementType::class);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        // Récupérez les données du formulaire
        $formData = $form->getData();

        // Créez un tableau associatif avec les données
        $data = [
           'name'         => 'John Doe',
            'address'      => 'USA',
            'mobileNumber' => '000000000',
            'email'        => 'john.doe@email.com',
            'date_entree'        => 'JJ/MM/AAAA',
            'date_sortie'        => 'JJ/MM/AAAA',
            'prix'        => '000 €',
        ];

        // Créez un fichier CSV
        $csv = Writer::createFromString('');
        $csv->insertOne(array_keys($data));
        $csv->insertOne(array_values($data));

        // Enregistrez le fichier CSV sur le serveur
        $csvFileName = 'payment_' . date('YmdHis') . '.csv';
        $csvFilePath = $this->getParameter('kernel.project_dir') . '/public/csv/' . $csvFileName;
        $csv->output($csvFilePath);

        // Redirigez vers la route de confirmation
        return $this->redirectToRoute('app_confirmation', ['csvFileName' => $csvFileName]);
    }

    return $this->render('paiement/index.html.twig', [
        'form' => $form->createView(),
    ]);
}
    
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


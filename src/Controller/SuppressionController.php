<?php

namespace App\Controller;

use App\Entity\Offer;
use App\Entity\Ticket;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SuppressionController extends AbstractController
{
    #[Route('/ticket/delete/{id}', name: 'ticket_delete', methods: ['POST'])]
    public function deleteTicket(int $id, EntityManagerInterface $entityManager, Request $request): Response
    {
        $ticket = $entityManager->getRepository(Ticket::class)->find($id);

        if (!$ticket) {
            throw $this->createNotFoundException('Le ticket n\'existe pas.');
        }

        

            $entityManager->remove($ticket);
            $entityManager->flush();

            $this->addFlash('success', 'Le ticket a été supprimé avec succès.');


        return $this->redirectToRoute('admin_ticket_list');
    }

    #[Route('/offer/delete/{id}', name: 'offer_delete', methods: ['POST'])]
    public function deleteOffer(int $id, EntityManagerInterface $entityManager, Request $request): Response
    {
        $festival = $entityManager->getRepository(Offer::class)->find($id);

        if (!$festival) {
            throw $this->createNotFoundException('L\'offre n\'existe pas.');
        }

       

            $entityManager->remove($festival);
            $entityManager->flush();

            $this->addFlash('success', 'L\'offre a été supprimé avec succès.');


        return $this->redirectToRoute('admin_offer_list');
    }
}

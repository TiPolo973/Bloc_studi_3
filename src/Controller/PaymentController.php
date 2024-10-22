<?php
// src/Controller/PaymentController.php
namespace App\Controller;

use App\Entity\Ticket;
use Doctrine\ORM\EntityManagerInterface;
use Stripe\Checkout\Session;
use Stripe\Stripe;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\HttpFoundation\Request;




class PaymentController extends AbstractController
{
    #[Route('/create-checkout-session/{id}', name: 'checkout_checkout_create')]
    public function createCheckoutSession(Ticket $ticket): Response
    {

        Stripe::setApiKey($this->getParameter('stripe.secret_key'));
        Stripe::setApiVersion('2024-09-30.acacia');

        $ticketId = $ticket->getId();
        $prixcentime = $ticket->getPrice() * 100;
        $offer = $ticket->getOffer();
        
        if (!$offer) {
            throw $this->createNotFoundException("Le ticket n'est associé à aucune offre.");
        }
        $offerTitle = $offer->getTitle();

        $checkoutSession = Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price_data' => [
                    'currency' => 'eur',
                    'product_data' => [
                        'name' => 'Ticket pour l\'offre: ' . $offerTitle,
                    ],
                    'unit_amount' => $prixcentime,
                ],
                'quantity' => $ticket->getQuantity(),
            ]],
            'mode' => 'payment',
            'success_url' => $this->generateUrl('payment_success', ['id' => $ticketId], UrlGeneratorInterface::ABSOLUTE_URL),
            'cancel_url' => $this->generateUrl('payment_cancel', [], UrlGeneratorInterface::ABSOLUTE_URL),
        ]);
        // dd($checkoutSession);
        return $this->redirect($checkoutSession->url);
    }

    #[Route('/payment/success', name: 'payment_success')]
    public function paymentSuccess(Request $request, EntityManagerInterface $em)
    {
       $user = $this->getUser();

       $ticketId = $request->query->get('id');

       $ticket = $em->getRepository(Ticket::class)->find($ticketId);

       if ($ticket && $user) {
        $ticket->setUserId($user);
        $em->persist($ticket);
        $em->flush();
    } else {
        throw $this->createNotFoundException("Une erreur s'est produite");
    }

        return $this->render('payment/success.html.twig');
    }

    #[Route('/payment/cancel', name: 'payment_cancel')]
    public function paymentCancel()
    {
        return $this->render('payment/cancel.html.twig');
    }
}

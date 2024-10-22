<?php
// src/Controller/PaymentController.php
namespace App\Controller;

use Stripe\Checkout\Session;
use Stripe\Stripe;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Ticket;


#[Route('/create-checkout-session', name: 'checkout_')]
class PaymentController extends AbstractController
{
    #[Route('/', name: 'checkout_create')]
    public function createCheckoutSession()
    {
      
        Stripe::setApiKey($this->getParameter('stripe.secret_key'));
        Stripe::setApiVersion('2024-09-30.acacia');

        // $ticketId = $ticket->getId();

      
        $checkoutSession = Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price_data' => [
                    'currency' => 'eur',
                    'product_data' => [
                        'name' => 'Mon produit',
                    ],
                    'unit_amount' => 2000, // Montant en centimes (20 EUR)
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => 'http://127.0.0.1:8000/create-checkout-session/payment/success',
            'cancel_url' => 'http://127.0.0.1:8000/create-checkout-session/payment/cancel',
            // 'metadata' => [
            //     'ticket_id' => $ticketId
            // ]
        ]);

        // dd($checkoutSession);
        return $this->redirect($checkoutSession->url);
    }

    #[Route('/payment/success', name: 'payment_success')]
    public function paymentSuccess()
    {
        return $this->render('payment/success.html.twig');
    }

    #[Route('/payment/cancel', name: 'payment_cancel')]
    public function paymentCancel()
    {
        return $this->render('payment/cancel.html.twig');
    }
}

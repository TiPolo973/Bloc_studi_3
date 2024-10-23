<?php
namespace App\Controller;

use App\Entity\Offer;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Ticket;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping\Id;
use Symfony\Component\HttpFoundation\Response;

class HomeController extends AbstractController {
    

    #[Route('/', name:'index', methods:['GET'])]
    public function number(EntityManagerInterface $em) {
      $festival = $em->getRepository(Offer::class)->findAll();

      return $this->render('base.html.twig',[
            'festival'=> $festival
      ]);
    }

    #[Route('/achat/ticket',name:'_client',methods:['GET'])]
    public function achat(EntityManagerInterface $em ){
        $tickets = $em->getRepository(Ticket::class)->findBy(['user' => null]);

            return $this->render('user/clientticket.html.twig',[
                'tickets' => $tickets,
            ]);

    }

    #[Route('/Panier', name:'Panier')]
    public function panier(EntityManagerInterface $em): Response
    {
        $user = $this->getUser();
    
        if ($user) {
            $tickets = $em->getRepository(Ticket::class)->findBy(['user' => $user]);
        } else {
            $tickets = [];
        }
    
        return $this->render('user/Panier.html.twig', [
            'user' => $user,
            'tickets' => $tickets,
        ]);
    }
    

}
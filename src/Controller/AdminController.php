<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\OfferType;
use App\Form\TicketType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;


#[Route('/admin', name:'admin')]
class AdminController extends AbstractController
{
    #[Route('/', name: 'accueil')]
    public function index()
    {
        return $this->render('admin/index.html.twig');
    }


    #[Route('/list', name: '_list')]
    public function list(UserRepository $userRepository)
    {
        $users = $userRepository->findAll();
        
        return $this->render('admin/listuser.html.twig', [
            'users' => $users
        ]);
    }

    #[Route('/delete/{id}', name: '_delete_user', methods: ['POST'])]
    public function delete(User $user, EntityManagerInterface $em): Response
    {
            $em->remove($user);
            $em->flush();

            $this->addFlash('succes', "l'utilisateur à bien été effacé");

        return $this->redirectToRoute('adminaccueil');
    }

    #[Route('/ticket', name:'_ticket')]
    public function ticket(Request $request, EntityManagerInterface  $em,){


        $ticketform =  $this->createForm(TicketType::class);

        $ticketform->handleRequest($request);
        


        return $this->render('Admin/formticket.html.twig', [
            'ticketform'=> $ticketform,
        ]);
    }
    #[Route('/offer', name:'_offer')]
    public function offer(Request $request, EntityManagerInterface  $em,){


        $offerform =  $this->createForm(OfferType::class);

        $offerform->handleRequest($request);
        


        return $this->render('Admin/formoffer.html.twig', [
            'offerform'=> $offerform,
        ]);
    }
}

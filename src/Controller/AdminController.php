<?php

namespace App\Controller;

use App\Entity\Offer;
use App\Entity\Ticket;
use App\Entity\User;
use App\Form\OfferType;
use App\Form\TicketType;
use App\Repository\OfferRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use PhpParser\Node\Expr\List_;
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
        $newticket= new Ticket();

        $ticketform =  $this->createForm(TicketType::class, $newticket);

        $ticketform->handleRequest($request);

        if($ticketform->isSubmitted()){
            if($ticketform->isValid()){
                $em->persist($newticket);
                $em->flush();
                
                $this->addFlash('succes', 'Nouveaux ticket crée avec succès');
                
                return $this->redirectToRoute('adminaccueil');
            }
            else{
                $this->addFlash('error',"Une erreur c'est produite");
            }
        }
        


        return $this->render('Admin/formticket.html.twig', [
            'ticketform'=> $ticketform,
        ]);
    }
    #[Route('/offer', name:'_offer')]
    public function offer(Request $request, EntityManagerInterface  $em,):Response{

        //on crée un nouveaux formulaire
        $newform = new Offer();

        $offerform =  $this->createForm(OfferType::class, $newform);

        $offerform->handleRequest($request);

        if ($offerform->isSubmitted()){
            if($offerform->isValid()){
                $em->persist($newform);
                $em->flush();

                $this->addFlash('succes', 'Nouvel offre crée avec succès');

                return $this->redirectToRoute('adminaccueil');
            }else{
                $this->addFlash('error',"Une erreur c'est produite");
            }
        }
        


        return $this->render('Admin/formoffer.html.twig', [
            'offerform'=> $offerform->createView(),
        ]);
    }

    #[Route('/Offer/list',name:'_offer_list', methods:['GET'] )]
    public function offerlist(EntityManagerInterface $em){
        $offer = $em->getRepository(Offer::class)->findAll();

            return $this->render('Admin/listfestival.html.twig',[
                'Abcd' => $offer,
            ]);
        }

        #[Route('/ticket/list', name:'_ticket_list', methods:['GET'])]
        public function ticketlist(EntityManagerInterface $em){
            $tickets = $em->getRepository(Ticket::class)->findAll();

            return $this->render('Admin/listticket.html.twig',[
                'ticket' => $tickets,
            ]);
        }

        // #[Route('/ticket/add{id}' ,name:'_add_ticket', methods:['GET'])]
        // Public function ticketadd(EntityManagerInterface $em , string $id ):Response
        // {
        //     $user = $em->getRepository(User::class)->find($id);

        // }
}

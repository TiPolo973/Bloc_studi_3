<?php

namespace App\Controller;

use App\Form\UserType;
use App\Entity\User;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;


#[Route('/user', name: 'user_')]
class UserController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(): Response
    {
        return $this->render('user/index.html.twig', [
            'controller_name' => 'UserController',
        ]);
    }

    #[Route('/profil', name: 'profil')]
    public function profil(): Response
    {
        return $this->render('user/index.html.twig', [
            'controller_name' => 'La page profil',
        ]);
    }


    #[Route('/inscription', name: 'inscription', methods:['GET','POST'])]
    public function inscription(Request $request, EntityManagerInterface  $em ):Response
    {
        //on crée un nouvel utilisateur
        $user = new User();

        //on crée le formulaire
        $userform = $this->createForm(UserType::class, $user);

        //Vérifie la request
        $userform->handleRequest($request);


        if ($userform->isSubmitted() && $userform->isValid()){
            $em->persist($user);
            $em->flush();

            return $this->redirectToRoute('user/index.html.twig',[],Response::HTTP_SEE_OTHER);
        }
        return $this->render('user/adduser.html.twig', [
            'userform' => $userform->createView(),
        ]);
    }

}

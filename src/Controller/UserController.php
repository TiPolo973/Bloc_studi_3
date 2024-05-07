<?php

namespace App\Controller;

use App\Form\UserType;
use App\Entity\User;
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


    #[Route('/inscription', name: 'inscription')]
    public function inscription():Response
    {
        //on crée un nouvel utilisateur
        $user = new User();

        //on crée le formulaire
        $form = $this->createForm(UserType::class, $user);


        // return $this->render('user/adduser.html.twig',[
        //     'form' => $userform->createView()
        // ]);
        return $this->render('user/adduser.html.twig', [
            'form' => $form->createView(),
        ]);
    }

}

<?php

namespace App\Controller;

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

    #[Route('/detail',name: 'detail')]
    public function detail():Response
    {
        return $this->render('user/test.html.twig');
    }
}

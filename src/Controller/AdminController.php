<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


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

            $this->addFlash('succes', 'lutilisateur à bien été éffacer');

        return $this->redirectToRoute('adminaccueil');
    }
}

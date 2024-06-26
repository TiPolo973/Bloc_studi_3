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


#[Route('/user', name: 'user')]
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


    #[Route('/inscription', name: 'inscription', methods: ['GET', 'POST'])]
    public function inscription(Request $request, EntityManagerInterface  $em): Response
    {
        //on crée un nouvel utilisateur
        $user = new User();
        //on crée le formulaire
        $userform = $this->createForm(UserType::class, $user);
        //Vérifie la request
        $userform->handleRequest($request);

        $existingUser = $em->getRepository(User::class)->findOneBy(['email' => $user->getEmail()]);

        if ($existingUser) {
            $this->addFlash('error', 'Cette adresse e-mail est déjà utilisée.');

            return $this->render('user/adduser.html.twig', [
                'userform' => $userform->createView(),
            ]);
        }

        if ($userform->isSubmitted()) {

           
            if ($userform->isValid()) {
                $em->persist($user);
                $em->flush();

                $this->addFlash('success', 'Utilisateur ajouté avec succès.');

                return $this->redirectToRoute('uservalidate',[
                    'id' => $user->getId()
                ]);
            } else {
                $this->addFlash('error', 'Il y a des erreurs dans le formulaire. Veuillez les corriger.');
            }
        }

        return $this->render('user/adduser.html.twig', [
            'userform' => $userform->createView(),
        ]);
    }

    #[Route('/register', name: 'register', methods: ['GET', 'POST'])]
    public function register(Request $request, EntityManagerInterface $em): Response
    {
        // On crée un nouvel utilisateur
        $user = new User();

        // On crée le formulaire
        $userform = $this->createForm(UserType::class, $user);

        // Vérifie la request
        $userform->handleRequest($request);

        $existingUser = $em->getRepository(User::class)->findOneBy(['email' => $user->getEmail()]);

        if ($existingUser) {
            $this->addFlash('error', 'Cette adresse e-mail est déjà utilisée.');

            return $this->render('user/adduser.html.twig', [
                'userform' => $userform->createView(),
            ]);
        }

        if ($userform->isSubmitted() && $userform->isValid()) {

            $em->persist($user);
            $em->flush();

            $this->addFlash('success', 'Utilisateur ajouté avec succès.');

            return $this->redirectToRoute('uservalidate',[
                'id' => $user->getId(),
            ]);

        } elseif ($userform->isSubmitted()) {
            $this->addFlash('error', 'Il y a des erreurs dans le formulaire. Veuillez les corriger.');
        }

        return $this->render('user/adduser.html.twig', [
            'userform' => $userform->createView(),
        ]);
    }

    #[Route('/validate/{id}', name: 'validate')]
    public function validate(User $user): Response
    {

        return $this->render('form/tachesuccess.html.twig',[
            'user' => $user,
        ]);
    }



    #[Route('/list/{id}', name: 'user_id')]
    public function user_id(EntityManagerInterface $EntityManager, string $id): Response
    {
        $user = $EntityManager->getRepository(User::class)->find($id);

        if (!$user) {
            throw $this->createNotFoundException(
                'No product found for id ' . $id
            );
        }
        return new Response('Check out this great product: ' . $user->getName());
    }
}

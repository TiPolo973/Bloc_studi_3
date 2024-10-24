<?php

namespace App\Controller;

use App\Form\UserType;
use App\Entity\User;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping\Id;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\UserRepository;
use Symfony\Bundle\SecurityBundle\Security;

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

    #[Route('/profil/{id}', name: 'profil')]
    public function profil(string $id, UserRepository $userRepository): Response
    {
        
        $user = $userRepository->find($id);
        


        return $this->render('user/profil.html.twig', [
            'user' => $user,
        ]);
    }


    #[Route('/inscription', name: 'inscription', methods: ['GET', 'POST'])]
    public function inscription(Request $request, EntityManagerInterface  $em, UserPasswordHasherInterface $encoder): Response
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
                $uniqueKey = bin2hex(random_bytes(16));
                $user->setUserKey($uniqueKey);
                $user->setRoles(['ROLE_USER']);
                $hash = $encoder->hashPassword($user, $user->getPassword());
                $user->setPassword($hash);
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

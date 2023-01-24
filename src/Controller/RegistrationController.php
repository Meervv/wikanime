<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationFormType;
use App\Security\UsersAuthenticator;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\UserAuthenticatorInterface;

class RegistrationController extends AbstractController
{
    function generateRandomUsername() {
        $characters = '0123456789';
        $usernameLength = 8; //longueur du nom d'utilisateur
        $randomUsername = ''; //initialise la variable qui contiendra le nom de l'utilisateur générré aléatoirement

        for ($i = 0; $i < $usernameLength; $i++) { //boucle qui génère le nom d'utilisateur
            $randomUsername .= $characters[rand(0, strlen($characters) - 1)]; //ajoute un caractère aléatoire à la variable $randomUsername
        }
        return "user" . $randomUsername;
    }

    #[Route('/inscription', name: 'app_register')]
    public function register(Request $request, UserPasswordHasherInterface $userPasswordHasher, 
    UserAuthenticatorInterface $userAuthenticator, UsersAuthenticator $authenticator, 
    EntityManagerInterface $entityManager): Response
    {
        $user = new User();
        $form = $this->createForm(RegistrationFormType::class, $user); // create the form
        $form->handleRequest($request); // handle the request
        $randomUser = $this->generateRandomUsername();

        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
            $user->setPassword(
                $userPasswordHasher->hashPassword( // hash the password
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );
            $user->setPseudo($randomUser);

            $entityManager->persist($user); // save the user
            $entityManager->flush(); // flush the entity manager into the database
           
            // do anything else you need here, like send an email

            return $userAuthenticator->authenticateUser(
                $user,
                $authenticator,
                $request
            );
        }

        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }
}

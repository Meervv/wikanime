<?php

namespace App\Controller;


use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\Anime;
use App\Entity\User;
use App\Form\EditProfileType;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\SqlFormatter\Token;

class ProfileController extends AbstractController
{
    #[Route('/profil', name: 'app_profile')]
    public function index(ManagerRegistry $doctrine): Response
    {
        $user = $this->getUser();
        $repo = $doctrine->getManager()->getRepository(User::class);
        $listUsers = $repo->findAll();


        $animes = $doctrine->getRepository(Anime::class)->findAll();
        forEach($animes as $anime) {
            $anime->setSynopsis(substr($anime->getSynopsis(), 0, 200) . '...');
        }

        return $this->render('profile/index.html.twig', [
            'controller_name' => 'ProfileController',
            'user' => $user,
            'listUsers' => $listUsers,
            'animes' => $animes,
        ]);
    }

    #[Route('/edit-profile', name: 'app_profile_edit')]
    public function edit_profile(ManagerRegistry $doctrine, Request $request, EntityManagerInterface $manager): Response
    {    
        $user = $this->getUser();
        $form = $this->createForm(EditProfileType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $manager->persist($user);
            $manager->flush();
            return $this->redirectToRoute('app_profile');
        }
        return $this->render('profile/edit.html.twig', [
            'editForm' => $form
        ]);
    }
}

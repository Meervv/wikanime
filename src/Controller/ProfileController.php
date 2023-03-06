<?php

namespace App\Controller;

use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\Anime;
use App\Entity\Statut;
use App\Entity\User;
use App\Form\EditProfileType;
use Doctrine\ORM\EntityManagerInterface;

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
    public function edit_profile(Request $request, EntityManagerInterface $manager): Response
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
            'form' => $form
        ]);
    }

    #[Route('/favoris', name: 'app_favoris')]
    public function favoris(ManagerRegistry $doctrine, Request $request, EntityManagerInterface $manager): Response
    {    
        $user = $this->getUser();
        $status = $doctrine->getRepository(Statut::class)->findAll();
        $animes = $doctrine->getRepository(Anime::class)->findAll();
        $test = null;

        forEach($status as $statut) {
            forEach($animes as $anime) {
                if (!$statut->getId() == $anime->getStatut()->getId()) {
                    $test = $statut->getAnimes();
                }
                else {
                    $test = "NON";
                }
            }
        }
        return $this->render('profile/favoris.html.twig', [
            'status' => $status,
            'animes' => $animes,
            'test' => $test,
        ]);
    }
}

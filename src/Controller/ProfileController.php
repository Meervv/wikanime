<?php

namespace App\Controller;

use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\Anime;
use App\Entity\Statut;
use App\Form\EditProfileType;
use App\Form\ModifStatutFormType;
use App\Repository\UserRepository;
use App\Repository\AnimeRepository;
use App\Repository\StatutRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class ProfileController extends AbstractController
{
    #[Route('/profil', name: 'app_profile')]
    public function index(ManagerRegistry $doctrine, UserRepository $userRepository): Response
    {
        $user = $this->getUser();

        if ($this->IsGranted("ROLE_ADMIN")) {
            return $this->redirectToRoute('app_admin');
        }
        // $repo = $doctrine->getManager()->getRepository(User::class);
        // $listUsers = $repo->findBy(['totalEpisodesVus' => 'desc']);
        $listUsers = $userRepository->findBy([],['totalEpisodesVus' => 'desc']);

        $animes = $doctrine->getRepository(Anime::class)->findAll();
        forEach($animes as $anime) {
            $anime->setSynopsis(substr($anime->getSynopsis(), 0, 200) . '...');
        }

        $statuts = $doctrine->getRepository(Statut::class)->findAll();

        return $this->render('profile/index.html.twig', [
            'controller_name' => 'ProfileController',
            'user' => $user,
            'listUsers' => $listUsers,
            'animes' => $animes,
            'statuts' => $statuts,
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
            'editForm' => $form
        ]);
    }

    #[Route('/favoris', name: 'app_favoris')]
    public function favoris(ManagerRegistry $doctrine, Request $request, EntityManagerInterface $manager): Response
    {    
        $user = $this->getUser();
        $statuts = $doctrine->getRepository(Statut::class)->findAll();
        $animes = $doctrine->getRepository(Anime::class)->findAll();
        $test = null;

        // forEach($status as $statut) {
        //     forEach($animes as $anime) {
        //         if (!$statut->getId() == $anime->getStatut()->getId()) {
        //             $test = $statut->getAnimes();
        //         }
        //         else {
        //             $test = "NON";
        //         }
        //     }
        // }
        return $this->render('profile/favoris.html.twig', [
            'statuts' => $statuts,
            'animes' => $animes,
            'user' => $user,
            'test' => $test,
        ]);
    }

    /**
    * @Route("/detail/{id}", name="app_detail")
    */
    public function show(int $id, StatutRepository $statutRepository, AnimeRepository $animeRepo, Request $request, EntityManagerInterface $manager): Response
    {
        $anime = $animeRepo->find($id);
        $user = $this->getUser();
        $statut = $statutRepository->findOneBy(['user' => $user, 'anime' => $anime]);

        if (!$anime) {
            throw $this->createNotFoundException('Anime non trouvé');
        }

        if (!$statut) {
            $statut = new Statut();
            $statut->setUser($user);
            $statut->setAnime($anime);
        }

        $form = $this->createForm(ModifStatutFormType::class, $statut);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $manager->persist($statut);
            $manager->flush();
            return $this->redirectToRoute('app_detail', ['id' => $id]);
        }

        return $this->render('detail/index.html.twig', [
            'anime' => $anime,
            'modifStatutForm' => $form,
        ]);
    }
}

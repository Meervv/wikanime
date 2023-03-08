<?php

namespace App\Controller;

use App\Data\SearchData;
use App\Entity\Anime;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\SearchFormType;
use App\Repository\AnimeRepository;

class HomeController extends AbstractController
{
    #[Route('/accueil', name: 'app_home')]
    public function index(ManagerRegistry $doctrine, Request $request, AnimeRepository $repository): Response
    {
        $animes = $doctrine->getRepository(Anime::class)->findAll();
        
        // $data = new SearchData();
        // $form = $this->createForm(SearchFormType::class, $data);
        // $form->handleRequest($request);
        // $genres = $repository->findSearch($data);
        forEach($animes as $anime) {
            $anime->setSynopsis(substr($anime->getSynopsis(), 0, 200) . '...');
        }
        return $this->render('home/index.html.twig', [
            'animes' => $animes,
            // 'form' => $form->createView(),
            // 'genres' => $genres
        ]);
    }
}

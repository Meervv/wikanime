<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\AnimeRepository;
use App\Repository\GenreRepository;
use App\Repository\TypeRepository;

class HomeController extends AbstractController
{
    #[Route('/accueil', name: 'app_home')]
    public function index(Request $request, AnimeRepository $animeRepo, GenreRepository $genreRepo, TypeRepository $typeRepo): Response
    {
        // $animes = $animeRepo->findAll();
        $genres = $genreRepo->findAll();
        $types = $typeRepo->findAll();

        $genreId = $request->query->getInt('genre');
        $typeId = $request->query->getInt('type');
       
        if ($genreId != null && $typeId == null) {
            $animes = $animeRepo->findBy(['genre' => $genreId]);
        }
        if ($genreId == null && $typeId != null) {
            $animes = $animeRepo->findBy(['type' => $typeId]);
        }
        if ($genreId != null && $typeId != null) {
            $animes = $animeRepo->findBy(['genre' => $genreId, 'type' => $typeId]);
        }
        if ($genreId == null && $typeId == null) {
            $animes = $animeRepo->findAll();
        }

        forEach($animes as $anime) {
            $anime->setSynopsis(substr($anime->getSynopsis(), 0, 200) . '...');
        }
        return $this->render('home/index.html.twig', [
            'animes' => $animes,
            'genres' => $genres,
            'types' => $types,
            'selectedGenre' => $genreId,
            'selectedTheme' => $typeId,
        ]);
    }
}

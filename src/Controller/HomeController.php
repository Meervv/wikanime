<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\AnimeRepository;
use App\Repository\GenreRepository;
use App\Repository\ThemeRepository;

class HomeController extends AbstractController
{
    #[Route('/accueil', name: 'app_home')]
    public function index(Request $request, AnimeRepository $animeRepo, GenreRepository $genreRepo, ThemeRepository $themeRepo): Response
    {
        // $animes = $animeRepo->findAll();
        $genres = $genreRepo->findAll();
        $themes = $themeRepo->findAll();

        $genreId = $request->query->getInt('genre');
        $themeId = $request->query->getInt('theme');
       
        if ($genreId != null && $themeId == null) {
            $animes = $animeRepo->findBy(['genre' => $genreId]);
        }
        if ($genreId == null && $themeId != null) {
            $animes = $animeRepo->findBy(['theme' => $themeId]);
        }
        if ($genreId != null && $themeId != null) {
            $animes = $animeRepo->findBy(['genre' => $genreId, 'theme' => $themeId]);
        }
        if ($genreId == null && $themeId == null) {
            $animes = $animeRepo->findAll();
        }

        forEach($animes as $anime) {
            $anime->setSynopsis(substr($anime->getSynopsis(), 0, 200) . '...');
        }
        return $this->render('home/index.html.twig', [
            'animes' => $animes,
            'genres' => $genres,
            'themes' => $themes,
            'selectedGenre' => $genreId,
            'selectedTheme' => $themeId,
        ]);
    }
}

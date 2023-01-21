<?php

namespace App\Controller;

use App\Entity\Anime;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/accueil', name: 'app_home')]
    public function index(ManagerRegistry $doctrine): Response
    {
        $animes = $doctrine->getRepository(Anime::class)->findAll();
        forEach($animes as $anime) {
            $anime->setSynopsis(substr($anime->getSynopsis(), 0, 200) . '...');
        }
        return $this->render('home/index.html.twig', [
            'animes' => $animes,
        ]);
    }
}

<?php

namespace App\Controller;

use App\Entity\Anime;
use App\Entity\Genre;
use App\Entity\Type;
use App\Form\AnimeType;
use App\Form\GenreType;
use App\Form\TypeType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

class AdminController extends AbstractController
{
    #[Route('/admin', name: 'app_admin')]
    public function index(): Response
    {
        return $this->render('admin/index.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }

    #[Route('/admin/add', name: 'app_admin_add')]
    public function addAnime(Request $request, EntityManagerInterface $manager) : Response {
        $anime = new Anime();
        $genre = new Genre();
        $type = new Type();
        
        $formAnime = $this->createForm(AnimeType::class, $anime);
        $formGenre = $this->createForm(GenreType::class, $genre);
        $formType = $this->createForm(TypeType::class, $type);

        $formAnime->handleRequest($request);
        $formGenre->handleRequest($request);
        $formType->handleRequest($request);

        if ($formAnime->isSubmitted() && $formAnime->isValid()) {
            $manager->persist($anime);
            $manager->flush();
            return $this->redirectToRoute('app_admin');
        }
        if ($formGenre->isSubmitted() && $formGenre->isValid()) {
            $manager->persist($genre);
            $manager->flush();
            return $this->redirectToRoute('app_admin');
        }
        if ($formType->isSubmitted() && $formType->isValid()) {
            $manager->persist($type);
            $manager->flush();
            return $this->redirectToRoute('app_admin');
        }
        return $this->render('admin/add.html.twig', [
            'controller_name' => 'AdminController',
            'formAnime' => $formAnime,
            'formGenre' => $formGenre,
            'formType' => $formType
        ]);
    }
}

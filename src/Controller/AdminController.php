<?php

namespace App\Controller;

use App\Entity\Anime;
use App\Entity\Genre;
use App\Entity\Type;

use App\Form\AnimeAddType;
use App\Form\GenreAddType;
use App\Form\TypeAddType;

use App\Form\AnimeEditType;

use App\Repository\AnimeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    #[Route('/admin', name: 'app_admin')]
    public function index(AnimeRepository $animeRepo): Response
    {
        $animes = $animeRepo->findAll();
        forEach($animes as $anime) {
            $anime->setSynopsis(substr($anime->getSynopsis(), 0, 200) . '...');
        }
        return $this->render('admin/index.html.twig', [
            'animes' => $animes
        ]);
    }

    #[Route('/admin/add', name: 'app_admin_add')]
    public function add(Request $request, EntityManagerInterface $manager) : Response {
        $anime = new Anime();
        $genre = new Genre();
        $type = new Type();
        
        $formAnime = $this->createForm(AnimeAddType::class, $anime);
        $formGenre = $this->createForm(GenreAddType::class, $genre);
        $formType = $this->createForm(TypeAddType::class, $type);

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
    
    #[Route('/admin/edit/{id}', name: 'app_admin_edit')]

    public function edit(int $id, ManagerRegistry $doctrine, Request $request, EntityManagerInterface $manager) : Response {
        $anime = $doctrine->getRepository(Anime::class)->find($id);
        if (!$anime) {
            throw $this->createNotFoundException('L\'anime n\'existe pas');
        }
        $form = $this->createForm(AnimeEditType::class, $anime);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $manager->persist($anime);
            $manager->flush();
            return $this->redirectToRoute('app_admin');
        }
        return $this->render('admin/edit.html.twig', [
            'formAnime' => $form
        ]);
    }

    #[Route('/admin/delete/{id}', name: 'app_admin_delete')]
public function delete(int $id, ManagerRegistry $doctrine, EntityManagerInterface $manager) : Response {
    $anime = $doctrine->getRepository(Anime::class)->find($id);
    if (!$anime) {
        throw $this->createNotFoundException('L\'anime n\'existe pas');
    }
    // dd($anime);
    $manager->remove($anime);
    $manager->flush();
    return $this->redirectToRoute('app_admin');
}

}

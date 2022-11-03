<?php

namespace App\Controller;

use App\Repository\GenreRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/genre')]
class AdminGenreController extends AbstractController
{
    #[Route('/', name: 'app_admin_genre')]
    public function index(GenreRepository $genreRepository): Response
    {
        return $this->render('admin_genre/index.html.twig', [
            'controller_name' => 'AdminGenreController',
            'genres'=>$genreRepository->findAll()
        ]);
    }
}

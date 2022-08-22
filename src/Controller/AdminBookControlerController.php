<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Genre;
use App\Entity\Emprunteur;
use App\Entity\Emprunt;
use App\Entity\Book;
use App\Entity\Auteur;
use App\Repository\UserRepository;
use App\Repository\GenreRepository;
use App\Repository\EmprunteurRepository;
use App\Repository\EmpruntRepository;
use App\Repository\BookRepository;
use App\Repository\AuteurRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminBookControlerController extends AbstractController
{
    #[Route('/admin/book/request', name: 'app_admin_book_controler')]
    public function index(BookRepository $bookRepository,ManagerRegistry $doctrine,GenreRepository $genreRepository, AuteurRepository $auteurRepository): Response
    {
        $books=$bookRepository->findAll();
        dump($books);

        $books=$bookRepository->find(1);
        dump($books);

        $keyword="Lorem";
        $books=$bookRepository->findByKeyword($keyword);
        dump($books);

        $auteur=$auteurRepository->find(2);
        $books=$auteur->getNom();
        $books=$bookRepository->findByAuteur($auteur);
        dump($books);
        exit();
        return $this->render('admin_book_controler/index.html.twig', [
            'controller_name' => 'AdminBookControlerController',
        ]);
    }
}

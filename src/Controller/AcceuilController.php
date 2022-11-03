<?php

namespace App\Controller;

use App\Entity\Book;
use App\Repository\AuteurRepository;
use App\Repository\BookRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AcceuilController extends AbstractController
{
    #[Route('/', name: 'acceuil')]
    public function index(BookRepository $bookRepository): Response
    {
        return $this->render('acceuil/index.html.twig', [
            'controller_name' => 'AcceuilController',
            'books'=>$bookRepository->findAll()
        ]);
    }
    #[Route(path: 'livre/{id}', name: 'details')]
    public function bookDetail(Book $book, AuteurRepository $auteurRepository): Response
    {
        
        return $this->render('acceuil/book_details.html.twig',[
            
            'book'=>$book,
            'auteurs'=>$auteurRepository->findOneByBooks($book),
        ]
            
        );
    }
}

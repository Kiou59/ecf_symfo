<?php

namespace App\Controller;

use App\Entity\Book;
use App\Form\SearchBookType;
use App\Repository\AuteurRepository;
use App\Repository\BookRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AcceuilController extends AbstractController
{
    #[Route('/', name: 'acceuil')]
    public function index(BookRepository $bookRepository, Request $request): Response
    {
        $books=$bookRepository->findAll();

        $form=$this->createForm(SearchBookType::class);

        $search=$form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $books=$bookRepository->filter($search->get('mot')->getData());
        }

        return $this->render('acceuil/index.html.twig', [
            'controller_name' => 'AcceuilController',
            'books'=>$books,
            'form'=>$form->createView()
        ]);
    }
    #[Route(path: 'livre/{id}', name: 'book_details')]
    public function bookDetail(Book $book, AuteurRepository $auteurRepository): Response
    {
        
        return $this->render('acceuil/book_details.html.twig',[
            
            'book'=>$book,
            'auteurs'=>$auteurRepository->findOneByBooks($book),
        ]
            
        );
    }
}

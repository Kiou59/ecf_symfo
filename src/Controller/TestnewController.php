<?php

namespace App\Controller;

use App\Entity\Book;
use App\Entity\Emprunt;
use App\Repository\AuteurRepository;
use App\Repository\BookRepository;
use App\Repository\EmprunteurRepository;
use App\Repository\EmpruntRepository;
use App\Repository\GenreRepository;
use DateTimeImmutable;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class TestnewController extends AbstractController
{
    #[Route('/test/new/book', name: 'test_new_book')]
    public function index(AuteurRepository $auteurRepository, GenreRepository $genreRepository, BookRepository $bookRepository): Response
    {

            $auteurs=$auteurRepository->findAll();
            $genres= $genreRepository->findAll();
            $book= new Book;
                $book->setTitle("Totum autem id externum");
                $book->setAnneeEdition(2020);
                $book->setNombrePages(300);
                $book->setCodeIsbn("9790412882714");
                $book->setAuteur($auteurs[2]);
                $book->addGenre($genres[6]);
            $bookRepository->add($book, true);


        return $this->render('testnew/index.html.twig', [
            'controller_name' => 'TestnewController',
        ]);
    }
    #[Route('/test/edit/book', name: 'test_edit_book')]
    public function editBook(ManagerRegistry $doctrine , AuteurRepository $auteurRepository, GenreRepository $genreRepository, BookRepository $bookRepository): Response
    {
        $genres= $genreRepository->findAll();
            $book= $bookRepository->find(2);
            $genre=$genreRepository->findByBook($book);

            $book->setTitle("Aperiendum est igitur");
            foreach($genre as $g){
                $book->removeGenre($g);
            }
            $book->addGenre($genres[5]);

            $book=$doctrine->getManager();
            $book->flush();

        return $this->render('testnew/index.html.twig', [
            'controller_name' => 'TestnewController',
        ]);
    }
    #[Route('/test/remove/book', name: 'test_remove_book')]
    public function removeBook(BookRepository $bookRepository): Response
    {
        
            $book= $bookRepository->find(123);
            $bookRepository->remove($book, true);


        return $this->render('testnew/index.html.twig', [
            'controller_name' => 'TestnewController',
        ]);
    }
        #[Route('/test/new/emprunteur', name: 'test_new_emprunteur')]
    public function newEmprunteur(EmpruntRepository $empruntRepository, EmprunteurRepository $emprunteurRepository, BookRepository $bookRepository): Response
    {

            $emprunteur=$emprunteurRepository->findAll();
            $book=$bookRepository->findAll();
            $emprunt= new Emprunt;
                $emprunt->setDateEmprunt(DateTimeImmutable::createFromFormat('Ymd H:i:s', '20201201 16:00:00'));
                $emprunt->setDateRetour(null);
                $emprunt->setEmprunteur($emprunteur[0]);
                $emprunt->setBook($book[0]);
            $empruntRepository->add($emprunt, true);
        return $this->render('testnew/emprunteur.html.twig', [
            'controller_name' => 'TestnewController',
        ]);
    }
    #[Route('/test/edit/emprunt', name: 'test_edit_emprunt')]
    public function editEmprunteur(ManagerRegistry $doctrine, EmpruntRepository $empruntRepository): Response
    {

            $emprunt=$empruntRepository->find(3);
            
            $emprunt->setDateRetour( DateTimeImmutable::createFromFormat('Ymd H:i:s', '20200501 10:00:00'));
            $emprunt= $doctrine->getManager();
            $emprunt->flush();

        return $this->render('testnew/emprunteur.html.twig', [
            'controller_name' => 'TestnewController',
        ]);
    }
    #[Route('/test/remove/emprunteur', name: 'test_remove_emprunteur')]
    public function removeEmprunteur(EmpruntRepository $empruntRepository): Response
    {

            $emprunt=$empruntRepository->find(42);
            
            $empruntRepository->remove($emprunt, true);

        return $this->render('testnew/emprunteur.html.twig', [
            'controller_name' => 'TestnewController',
        ]);
    }
}

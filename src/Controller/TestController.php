<?php

namespace App\Controller;

use App\Repository\AuteurRepository;
use App\Repository\BookRepository;
use App\Repository\EmprunteurRepository;
use App\Repository\EmpruntRepository;
use App\Repository\UserRepository;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class TestController extends AbstractController
{
    #[Route('/test/lecture/livre', name: 'app_controler_book')]
    public function readBook(AuteurRepository $auteurRepository ,BookRepository $bookRepository): Response
    {
        $books=$bookRepository->findAll();
        dump($books);

        $book1=$bookRepository->find(1);
        dump($book1);

        $keyword="lorem ";
        $booksLorem=$bookRepository->findByKeyword($keyword);
        dump($booksLorem);

        $auteur=$auteurRepository->find(2);
        
        $booksAuth=$bookRepository->findByAuteur($auteur);
        dump($booksAuth);


        $keyword="roman";
        $booksByGenre=$bookRepository->findByKeywordGenre($keyword);
        dump($booksByGenre);

        exit();
        return $this->render('controler_test/index.html.twig', [
            'controller_name' => 'ControlerTestController',
        ]);
    }


    #[Route('/test/lecture/users', name: 'app_controler_users')]
    public function readUsers(UserRepository $userRepository): Response
    {
                    // récupération de la liste complète de toutes les users
                    $users = $userRepository->findAll();
                    //inspection de la liste
                    dump($users);
            
                    // récupération d'un objet à partir de son id
                    $id = 1;
                    $user = $userRepository->find($id);
                    dump($user);
            
                    // récupération d'un objet à partir de mots cles
                    $user = $userRepository->findByEmail('foo.foo@example.com');
                    dump($user);
            
                    $role ="ROLE_EMPRUNTEUR";
                    $users = $userRepository->findByRoles($role);
                    dump($users);
                    exit();
        return $this->render('controler_test/userRead.html.twig', [
            'controller_name' => 'ControlerTestController',
        ]);
    }

    #[Route('/test/lecture/emprunteur', name: 'app_controler_emprunteur')]
    public function emprunteurRead (EmprunteurRepository $emprunteurRepository): Response
    {
        $emprunteur=$emprunteurRepository->findAll();
        dump($emprunteur);

        $emprunteurId=$emprunteurRepository->findById(3);
        dump($emprunteurId);

        $keyword='foo';
        $emprunteurByKey=$emprunteurRepository->findByKeyword($keyword);
        dump($emprunteurByKey);

        $telNum='1234';
        $emprunteurByTel=$emprunteurRepository->findByTel($telNum);
        dump($emprunteurByTel);
// date modifié pour obtenir des resultat
        $createdAt=DateTime::createFromFormat('Ymd H:i:s', '20220301 00:00:00');
        $emprunteurByDate=$emprunteurRepository->findByCreatedAt($createdAt);
        dump($emprunteurByDate);
        $emprunteurActif=$emprunteurRepository->isActif();
        dump($emprunteurActif);
        exit();
        return $this->render('controler_test/emprunteurRead.html.twig', [
            'controller_name' => 'ControlerTestController',
        ]);
    }
    #[Route('/test/lecture/emprunt', name: 'app_controler_emprunt')]
    public function empruntRead(EmpruntRepository $empruntRepository,EmprunteurRepository $emprunteurRepository, BookRepository $bookRepository): Response
    {
        $emprunts= $empruntRepository->findByLastTen();
        dump($emprunts);

        $emprunteur=$emprunteurRepository->find(2);
        $emprunts=$empruntRepository->findByEmprunteur($emprunteur);
        dump($emprunts);
        $book=$bookRepository->find(3);

        $emprunts=$empruntRepository->findByBook($book);
        dump($emprunts);

        $emprunts=$empruntRepository->findByRetour();
        dump($emprunts);
        exit();
        return $this->render('emprunts/empruntRead.html.twig', [
            'controller_name' => 'EmpruntsController',
        ]);
    }
    #[Route('/test/lecture/auteur', name: 'app_controler_auteurs')]
    public function readAuteurs(AuteurRepository $auteurRepository): Response
    {
                    // récupération de la liste complète de toutes les users
                    $auteurs = $auteurRepository->findAll();
                    //inspection de la liste
                    dump($auteurs);
            

                    exit();
        return $this->render('controler_test/userRead.html.twig', [
            'controller_name' => 'ControlerTestController',
        ]);
    }
}

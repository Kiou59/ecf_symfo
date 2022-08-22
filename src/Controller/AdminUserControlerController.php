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

class AdminUserControlerController extends AbstractController
{

    #[Route('/db/user/request', name: 'app_db_user_request')]
    public function userRequest(UserRepository $userRepository,ManagerRegistry $doctrine): Response
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
    }
}

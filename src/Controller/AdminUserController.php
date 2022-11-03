<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/user')]
class AdminUserController extends AbstractController
{
    #[Route('/', name: 'app_admin_user', methods:['GET'])]
    public function index(UserRepository $userRepository): Response
    {
        return $this->render('admin_user/index.html.twig', [
            'controller_name' => 'AdminUserController',
            'users'=>$userRepository->findAll()
        ]);
    }
}

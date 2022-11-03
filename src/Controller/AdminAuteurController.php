<?php

namespace App\Controller;

use App\Repository\AuteurRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
#[Route('/admin/auteur')]
class AdminAuteurController extends AbstractController
{
    #[Route('/', name: 'app_admin_auteur')]
    public function index(AuteurRepository $auteurRepository): Response
    {
        return $this->render('admin_auteur/index.html.twig', [
            'controller_name' => 'AdminAuteurController',
            'auteurs'=>$auteurRepository->findAll()
        ]);
    }
}

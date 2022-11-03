<?php

namespace App\Controller;

use App\Repository\EmprunteurRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/emprunteur')]
class AdminEmprunteurController extends AbstractController
{
    #[Route('/', name: 'app_admin_emprunteur')]
    public function index(EmprunteurRepository $emprunteurRepository): Response
    {
        return $this->render('admin_emprunteur/index.html.twig', [
            'controller_name' => 'AdminEmprunteurController',
            'emprunteurs'=>$emprunteurRepository->findAll()
        ]);
    }
}

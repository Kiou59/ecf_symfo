<?php

namespace App\Controller;

use App\Repository\EmpruntRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
#[Route('/admin/emprunt')]
class AdminEmpruntController extends AbstractController
{
    #[Route('/', name: 'app_admin_emprunt')]
    public function index(EmpruntRepository $empruntRepository): Response
    {
        return $this->render('admin_emprunt/index.html.twig', [
            'controller_name' => 'AdminEmpruntController',
            'emprunts'=>$empruntRepository->findAll()
        ]);
    }
}

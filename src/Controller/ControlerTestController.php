<?php

namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ControlerTestController extends AbstractController
{
    #[Route('/controler/test', name: 'app_controler_test')]
    public function index(): Response
    {
        return $this->render('controler_test/index.html.twig', [
            'controller_name' => 'ControlerTestController',
        ]);
    }
}

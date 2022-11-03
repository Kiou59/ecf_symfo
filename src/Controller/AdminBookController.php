<?php

namespace App\Controller;

use App\Repository\BookRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
#[Route('/admin/book')]
class AdminBookController extends AbstractController
{
    #[Route('/admin/book', name: 'app_admin_book')]
    public function index(BookRepository $bookRepository): Response
    {
        return $this->render('admin_book/index.html.twig', [
            'controller_name' => 'AdminBookController',
            'books'=>$bookRepository->findAll()
        ]);
    }
}

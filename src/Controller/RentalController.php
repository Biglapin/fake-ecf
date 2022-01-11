<?php

namespace App\Controller;

use App\Repository\BookRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RentalController extends AbstractController
{
    #[Route('/rental', name: 'rental')]
    public function indexBis(bookRepository $bookRepository): Response
    {
        return $this->render('rental/rental.html.twig', [
            'books' => $bookRepository->findBook(),
        ]);
    }


    public function index(BookRepository $bookRepository): Response
    {
        return $this->render('rental/rental.html.twig', [
            'books' => $bookRepository->findAll(),
        ]);
    }
}

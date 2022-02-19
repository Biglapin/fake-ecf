<?php

namespace App\Controller;

use App\Repository\BookRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

class RentalController extends AbstractController
{   
    #[IsGranted('ROLE_USER')]
    #[Route('/rental', name: 'rental')]
/*     public function indexBis(bookRepository $bookRepository): Response
    {
        return $this->render('rental/rental.html.twig', [
            'books' => $bookRepository->findBook(),
        ]);
    }
 */

 //Bundle KNP pour gérer la pagination 
    

    public function index( Request $request, BookRepository $bookRepository, PaginatorInterface $paginator): Response
    {
        $book = $bookRepository->findAll();
        
        $book = $paginator->paginate(
            $book, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            10/*limit per page*/
        );

        return $this->render('rental/rental.html.twig', [
            'books' => $book,
        ]);
    }
}

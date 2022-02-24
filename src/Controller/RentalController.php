<?php

namespace App\Controller;

use App\Classe\Search;
use App\Entity\Book;
use App\Entity\Genre;
use App\Form\SearchType;
use App\Repository\BookRepository;
use App\Repository\GenreRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

class RentalController extends AbstractController
{   
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }



    #[IsGranted('ROLE_USER')]
    #[Route('/rental', name: 'rental')]
    //Bundle KNP pour gérer la pagination 
    public function index( Request $request, BookRepository $bookRepository, PaginatorInterface $paginator, GenreRepository $genreRepository): Response
    {

       // $book = $this->entityManager->getRepository(Genre::class)->findAll();
        $search = new Search();
        $form = $this->createForm(SearchType::class, $search);
        
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
           
            $book = $this->entityManager->getRepository(Book::class)->findWithSearch($search);
           
        } else {
            $book = $this->entityManager->getRepository(Book::class)->findAll();
            $book = $paginator->paginate(
                $book, /* query NOT result */
                $request->query->getInt('page', 1)/*page number*/,
                10/*limit per page*/
            );
        }


        return $this->render('rental/rental.html.twig', [
            'books' => $book,
            'form' => $form->createView(),
        ]);
    }
}

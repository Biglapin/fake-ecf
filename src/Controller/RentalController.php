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
use Symfony\Component\HttpFoundation\JsonResponse;

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
        $genres = $genreRepository->findAll();
        
        $form->handleRequest($request);
        if ($request->get("ajax")){
            $genresCheckbox = $request->get('genre');
            $books = $bookRepository->findBy(["genre" => $genresCheckbox]);

            $responses = [];

            foreach($books as $key => $book){
                $responses[$key]["id"] = $book->getId(); 
                
            }
            
            if ($responses == []){
                $books = $bookRepository->findAll();
                $responses = [];

                foreach($books as $key => $book){
                    $responses[$key]["id"] = $book->getId(); 
                    
                }
            }
            return new JsonResponse([
                'books' => $responses
            ]);
        }

        //validation du formulaire
        if ($form->isSubmitted() && $form->isValid()){
            if (isset($search)){
                $books = $bookRepository->findWithSearch($search);
                dd($search);
            } 
        
        } else {
            $books = $this->entityManager->getRepository(Book::class)->findAll();
            $books = $paginator->paginate(
                $books, /* query NOT result */
                $request->query->getInt('page', 1)/*page number*/,
                10/*limit per page*/
            );
        }


        return $this->render('rental/rental.html.twig', [
            'books' => $books,
            'genres' => $genres,
            'form' => $form->createView(),
        ]);
    }
}

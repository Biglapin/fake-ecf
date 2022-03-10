<?php

namespace App\Controller;

use App\Classe\Search;
use App\Entity\Book;
use App\Form\SearchType;
use App\Repository\BookRepository;
use App\Repository\GenreRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;

class RentalController extends AbstractController
{   
    public function __construct(
        EntityManagerInterface $entityManager, 
        private ManagerRegistry $doctrine, 
        private SerializerInterface $serializer)
    {
        $this->entityManager = $entityManager;
        $this->serializer = $serializer;
    }


    #[IsGranted('ROLE_USER')]
    #[Route('/rental', name: 'rental')]   
    public function index( Request $request, BookRepository $bookRepository, PaginatorInterface $paginator, GenreRepository $genreRepository): Response
    {
        $search = new Search();
        $form = $this->createForm(SearchType::class, $search);
        $genres = $genreRepository->findAll();
        
        $form->handleRequest($request);

        //ajax response for the rental search and the checkbox
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

        //Form validation 
        if ($form->isSubmitted() && $form->isValid()){
            if (isset($search)){
                $books = $bookRepository->findWithSearch($search);
            } 
        
        } else {
             //Bundle KNP pour gérer la pagination 
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
    

    #[Route('/allbook', name: 'all_book', methods: ['GET'])]  
    public function fetchAllBook(SerializerInterface $serializer)
    {
        $bookAll = $this->doctrine
            ->getRepository(Book::class)
            ->findAll();
            //dd($bookAll);
        $data = $serializer->serialize($bookAll, 'json', ['groups' => "show_books"]);

        $response = new Response($data, 200, [
            'Content-Type', 'application/json'
        ]);
       
        return $response;
    }
}

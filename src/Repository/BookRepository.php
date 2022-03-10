<?php

namespace App\Repository;

use App\Classe\Search;
use App\Entity\Genre;
use App\Entity\Book;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Book|null find($id, $lockMode = null, $lockVersion = null)
 * @method Book|null findOneBy(array $criteria, array $orderBy = null)
 * @method Book[]    findAll()
 * @method Book[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BookRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Book::class);
    }

    /**
      * Request to search book 
      * @return Book[] Returns an array of Book objects
     */
    public function findWithSearch(Search $search)
    {
       $query =  $this
            ->createQueryBuilder('b')
            ->select('g', 'b')
            ->join('b.genre', 'g');
 

         if (!empty($search->genre)) {
            $query = $query
                ->andWhere('g.id IN (:name)')
                ->setParameter('name', $search->genre);
        }
        
        if (!empty($search->string)) {
            $query = $query
                ->andWhere("b.title LIKE :string")
                ->setParameter('string', "%{$search->string}%");    
        } 
      
        return $query->getQuery()->getResult();
    }
}

    



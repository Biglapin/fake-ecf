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
            dump($query);
         if(!empty($search->name)) {
                $query = $query
                ->andWhere('g.name LIKE :name')
                ->setParameter('name', $search->name);
                dump($search);
        }
        
        if (!empty($search->string)) {
            $query = $query
                ->andWhere("b.title = :string")
                ->setParameter('string', "%{$search->string}");
                dump($search);
        } 
      
        return $query->getQuery()->getResult();
    }
}

    /*
    public function findOneBySomeField($value): ?Book
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */


<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Faker\Factory;
use App\Entity\User;
use App\Entity\Book;
use App\Entity\Author;

class AppFixtures extends Fixture
{
    private UserPasswordHasherInterface $hasher;

    public function __construct(UserPasswordHasherInterface $hasher)
    {
        $this->hasher = $hasher;
    }


    public function load(ObjectManager $manager): void
    {
         $faker = Factory::create('fr-FR');
               // create 20 authors!
                for ($i = 0; $i < 20; $i++) {
                    $author = new Author();
                    $author->setLastName($faker->word(3, true));
                    $author->setFirstName('Prenom' .$i);

                    $manager->persist($author);
                }
    
                        // create book!
                for ($i = 0; $i < 20; $i++) {
                    $book = new Book;
                    $book->setTitle('title '.$i);
                    $book->setImages('/images/book.png');
                    $book->setPublishingDate($faker->dateTimeBetween('-6 month', 'now'));
                    $book->setDescription($faker->text(200));
                    $book->setIsReserved($faker->boolean(40));

                    $manager->persist($book);
                }   
                $manager->flush();
    }
}

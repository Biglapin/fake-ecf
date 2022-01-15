<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
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
        // $product = new Product();
        // $manager->persist($product);

       
/*        $user = new User();

        $user->setEmail('k@test.com');
        $user->setRoles(['ROLE_USER']);
        $user->setPassword($this->hasher->hashPassword($user, 'password'));


    $manager->persist($user);    */

         $faker = Factory::create('fr-FR');
               // create 20 authors!
                for ($i = 0; $i < 20; $i++) {
                    $author = new Author();
                    $author->setLastName($faker->word(3, true));
                    $author->setFirstName('Prenom' .$i);
                    $author->setIdAuthor(rand(1,100));

                    $manager->persist($author);
                }
    
                        // create book!
                for ($i = 0; $i < 20; $i++) {
                    $book = new Book;
                    $book->setIdBook(rand(1,200));
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

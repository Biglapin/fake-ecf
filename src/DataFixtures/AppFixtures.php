<?php

namespace App\DataFixtures;

use App\Entity\Admin;
use App\Entity\Author;
use App\Entity\Book;
use App\Entity\Genre;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Faker\Factory;

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

        $faker = Factory::create('fr-FR');
        $admin = new Admin();

        $admin->setEmail('user@test.com')
              ->setRoles(['ROLES_ADMIN']);

        $password = $this->hasher->hashPassword($admin, 'password');
        $admin->setPassword($password);

        $manager->persist($admin);

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
                    $book->setImage('/images/book.jpg');
                    $book->setPublishingDate($faker->dateTimeBetween('-6 month', 'now'));
                    $book->setDescription($faker->text(20));
                    $book->setIsReserved($faker->boolean(40));

                    $manager->persist($book);
                }
                $manager->flush();
    }
}

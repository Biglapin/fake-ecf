<?php

namespace App\Controller\Admin;

use App\Controller\BookController;
use App\Entity\Author;
use App\Entity\Book;
use App\Entity\Borrowing;
use App\Entity\Genre;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        return parent::index();
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Mediathèque');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Livre', 'fas fa-list', Book::class);
        yield MenuItem::linkToCrud('Genre', 'fas fa-user', Genre::class);
        yield MenuItem::linkToCrud('Author', 'fas fa-user', Author::class);
        yield MenuItem::linkToCrud('Borrowing', 'fas fa-user', Borrowing::class);
        yield MenuItem::linkToCrud('User', 'fas fa-user', User::class);
    }
}

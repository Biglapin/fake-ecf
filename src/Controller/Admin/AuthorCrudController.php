<?php

namespace App\Controller\Admin;

use App\Entity\Author;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class AuthorCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Author::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id_author'),
            TextField::new('first_name', 'Prénom'),
            TextField::new('last_name', "Nom"),
        ];
    }
    
}
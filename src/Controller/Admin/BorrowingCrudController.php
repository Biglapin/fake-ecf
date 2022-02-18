<?php

namespace App\Controller\Admin;

use App\Entity\Borrowing;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;

class BorrowingCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Borrowing::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [

            DateTimeField::new('start_date'),
            DateTimeField::new('end_date'),
            BooleanField::new('is_late'),
            AssociationField::new('book'),
            AssociationField::new('user')
        ];
    }
    
}

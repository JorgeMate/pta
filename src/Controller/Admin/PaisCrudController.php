<?php

namespace App\Controller\Admin;

use App\Entity\Pais;
use ContainerCV8UzyH\getCrudFormTypeService;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;

class PaisCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Pais::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud;
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}

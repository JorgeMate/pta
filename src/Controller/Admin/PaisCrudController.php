<?php

namespace App\Controller\Admin;

use App\Entity\Pais;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;


class PaisCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Pais::class;
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



    public function configureActions(Actions $actions): Actions
    {
        $importPais = Action::new('importPais', 'Importar datos del país', 'fa-solid fa-file-arrow-down')
            ->displayAsLink()
            ->setHtmlAttributes(['data-foo' => 'bar', 'target' => '_blank'])

        // if the route needs parameters, you can define them:
        // 1) using an array
        ->linkToRoute('app_login', []);



        return $actions->add(Crud::PAGE_DETAIL, $importPais);

    }
}

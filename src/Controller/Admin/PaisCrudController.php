<?php

namespace App\Controller\Admin;

use App\Entity\Pais;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;




class PaisCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Pais::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
           
            IdField::new('id')->hideOnForm(),
           
            Field::new('name_common'),
            Field::new('name_official')->hideOnIndex(),
            Field::new('capital'),
            Field::new('region')->hideOnIndex(),
            Field::new('subregion'),
            Field::new('flag'),
            Field::new('tld'),
            NumberField::new('area')->setNumDecimals(0),
            NumberField::new('population')->setNumDecimals(0),
            
        ];
    }
    

}

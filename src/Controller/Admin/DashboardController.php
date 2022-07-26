<?php

namespace App\Controller\Admin;

use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

use App\Entity\Pais;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;

class DashboardController extends AbstractDashboardController
{
    #[IsGranted('ROLE_ADMIN')]
    #[Route('/admin', name: 'admin_dashboard')]
    
    public function index(): Response
    {
        ##return parent::index();
        return $this->render('admin/index.html.twig');

        // Option 1. You can make your dashboard redirect to some common page of your backend
        //
        // $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        // return $this->redirect($adminUrlGenerator->setController(OneOfYourCrudController::class)->generateUrl());

        // Option 2. You can make your dashboard redirect to different pages depending on the user
        //
        // if ('jane' === $this->getUser()->getUsername()) {
        //     return $this->redirect('...');
        // }

        // Option 3. You can render some custom template to display a proper dashboard with widgets, etc.
        // (tip: it's easier if your template extends from @EasyAdmin/page/content.html.twig)
        //
        // return $this->render('some/path/my-dashboard.html.twig');

        
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('PAISES del mundo');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Panel de Control', 'fa fa-home');

        yield MenuItem::section();
        yield MenuItem::linkToCrud('Paises', 'fa-regular fa-flag', Pais::class);

        yield MenuItem::section();
        yield MenuItem::section('Importar');
        yield MenuItem::linkToRoute('Importar paises faltantes', 'fa-solid fa-angles-down', 'allCountries');
       
        yield MenuItem::section();
        yield MenuItem::section();
        yield MenuItem::linkToLogout('Salir', 'fa-solid fa-person-through-window');

        #yield MenuItem::linktoRoute('Actualizar info del Pais', 'fa-solid fa-file-import', 'oneCountry');
        
    }

    public function configureActions(): Actions
    {
        return parent::configureActions()
            ->add(Crud::PAGE_INDEX, Action::DETAIL);

    }


}

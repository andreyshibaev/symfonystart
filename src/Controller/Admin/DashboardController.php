<?php

namespace App\Controller\Admin;

use App\Entity\ProjectConfig;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Component\Security\Core\User\UserInterface;
use EasyCorp\Bundle\EasyAdminBundle\Config\UserMenu;

#[IsGranted('ROLE_ADMIN')]
class DashboardController extends AbstractDashboardController
{
    #[Route('/admin_account', name: 'admin_account')]
    public function index(): Response
    {
        //        return parent::index();

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
        return $this->render('bundles/EasyAdminBundle/page/content.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Панель управления')
            ->setFaviconPath('favicons/favicon-16x16.png');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToRoute('На сайт', 'fa fa-home', 'homepage');
        yield MenuItem::linkToDashboard('Панель управления', 'fa-solid fa-gauge');
        yield MenuItem::linkToCrud('Конфигурация', 'fa-solid fa-gear', ProjectConfig::class);
        yield MenuItem::linkToCrud('Пользователи', 'fa fa-user', User::class);
        yield MenuItem::section('Выйти из аккаунта');
        yield MenuItem::linkToLogout('Выход', 'fa-solid fa-door-open');
        // yield MenuItem::linkToCrud('The Label', 'fas fa-list', EntityClass::class);
    }

    public function configureCrud(): Crud
    {
        return Crud::new()
            ->showEntityActionsInlined()
            ->setPaginatorPageSize(7)
            ->setPaginatorRangeSize(1)
            ->hideNullValues();
    }

    public function configureUserMenu(UserInterface $user): UserMenu
    {
        return parent::configureUserMenu($user)
            ->setAvatarUrl('favicons/favicon-32x32.png')
            ->setName($user->getUserIdentifier());
    }
}

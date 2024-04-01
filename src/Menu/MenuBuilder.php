<?php

namespace App\Menu;

use Knp\Menu\FactoryInterface;
use Knp\Menu\ItemInterface;
use Symfony\Bundle\SecurityBundle\Security as NewSecurityHelper;

class MenuBuilder
{
    public function __construct(private readonly FactoryInterface $factory, private readonly NewSecurityHelper $security)
    {
    }

    public function createMainMenu(array $options): ItemInterface
    {
        $menu = $this->factory->createItem('root');
        $menu->setChildrenAttribute('class', 'navbar-nav me-auto mb-2 mb-lg-0');

        $menu
        ->addChild('Домашняя', [
            'route' => 'homepage'
        ])
        ->setAttribute('class', 'nav-item')
        ->setLinkAttribute('class', 'nav-link')
        ;
        return $menu;
    }

    public function createRightMenu(array $options): ItemInterface
    {
        $menu = $this->factory->createItem('rightmenu');
        $menu->setChildrenAttribute('class', 'navbar-nav d-flex');
        if ($this->security->isGranted('ROLE_USER')) {

            if ($this->security->isGranted('ROLE_ADMIN')) {
                $menu->addChild('Управление', [
                    'route' => 'admin_account'
                ])
                    ->setAttribute('class', 'nav-item')
                    ->setLinkAttribute('class', 'nav-link')
                ;
            }

            $menu->addChild('Профиль', [
                'route' => 'profilepage'
                ])
                ->setAttribute('class', 'nav-item')
                ->setLinkAttribute('class', 'nav-link')
            ;
            $menu->addChild('Выйти', [
                'route' => 'app_logout'
                ])
                ->setAttribute('class', 'nav-item')
                ->setLinkAttribute('class', 'nav-link')
            ;
        } else {
            $menu->addChild('Войти', [
                'route' => 'login_auth'
                ])
                ->setAttribute('class', 'nav-item')
                ->setLinkAttribute('class', 'nav-link')
            ;
        }

        return $menu;
    }
}

<?php

namespace App\Controller;

use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    #[Route(path: '/login-auth', name: 'login_auth')]
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        if ($this->getUser() instanceof UserInterface) {
            return $this->redirectToRoute('homepage');
        }

        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render(
            'security/login.html.twig',
            [
            'last_username' => $lastUsername,
            'error' => $error,
            'title' => 'Войти в аккаунт'
            ]
        );
    }

    /**
     * @throws Exception
     */
    #[Route(path: '/logout', name: 'app_logout')]
    public function logout(): never
    {
        //        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
        throw new Exception('logout() should never be reached');
    }
}

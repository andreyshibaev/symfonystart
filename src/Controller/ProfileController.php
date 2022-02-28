<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProfileController extends AbstractController
{
    #[Route('/profile', name: 'profile')]
    public function index(): Response
    {
		if ($this->getUser() == Null) {
            return $this->redirectToRoute('home');
        }

        return $this->render('profile/index.html.twig', [
            'title' => 'Profile',
        ]);
    }
}

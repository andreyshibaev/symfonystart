<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationFormType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\Mailer;
use Symfony\Component\Mailer\Transport;
use Symfony\Component\Mime\Email;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Core\User\UserInterface;
use SymfonyCasts\Bundle\VerifyEmail\Exception\VerifyEmailExceptionInterface;
use SymfonyCasts\Bundle\VerifyEmail\VerifyEmailHelperInterface;

use const PHP_EOL;

class RegistrationController extends AbstractController
{
    #[Route('/register-profile', name: 'register_profile')]
    public function register(
        Request                     $request,
        UserPasswordHasherInterface $userPasswordHasher,
        EntityManagerInterface      $entityManager,
        $admin_email,
        VerifyEmailHelperInterface  $verifyEmailHelper
    ): Response {
        if ($this->getUser() instanceof UserInterface) {
            return $this->redirectToRoute('homepage');
        }

        $user = new User();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user->setPassword(
                $userPasswordHasher->hashPassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );

            $user->setRoles(["ROLE_USER"]);
            $entityManager->persist($user);
            $entityManager->flush();

            $signatureComponents = $verifyEmailHelper->generateSignature(
                'app_verify_email',
                $user->getId(),
                $user->getEmail(),
                ['id' => $user->getId()]
            );
            $this->addFlash('success', 'Вам отправлено письмо с ссылкой. Нажмите на неё,
             чтобы активировать аккаунт перед входом в систему. ');
            $email = (new Email())
                ->from($admin_email)
                ->to($user->getEmail())
                ->subject('Письмо подтверждения почты')
                ->text('Перейти по ссылке ниже для подтверждения регистрации:' . PHP_EOL .
                    $signatureComponents->getSignedUrl());
            $transport = Transport::fromDsn($_ENV["MAILER_DSN"]);
            $mailer = new Mailer($transport);
            try {
                $mailer->send($email);
            } catch (TransportExceptionInterface $exception) {
                $exception->getDebug();
            }

            return $this->redirectToRoute('login_auth');
        }

        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form->createView(),
            'title' => 'Регистрация'
        ]);
    }

    #[Route('/verify/email', name: 'app_verify_email')]
    public function verifyUserEmail(Request $request, VerifyEmailHelperInterface $verifyEmailHelper, UserRepository $userRepository, EntityManagerInterface $entityManager): Response
    {
        $user = $userRepository->find($request->query->get('id'));
        if ($user === null) {
            throw $this->createNotFoundException();
        }

        try {
            $verifyEmailHelper->validateEmailConfirmation(
                $request->getUri(),
                $user->getId(),
                $user->getEmail(),
            );
        } catch (VerifyEmailExceptionInterface $verifyEmailException) {
            $this->addFlash('error', $verifyEmailException->getReason());
            return $this->redirectToRoute('register_profile');
        }

        $user->setIsVerified(true);
        $entityManager->flush();
        $this->addFlash('success', 'Ваш аккаунт подтверждён! Вы можете войти.');
        return $this->redirectToRoute('login_auth');
    }


    #[Route('/verify/resend', name: 'app_verify_resend_email')]
    public function resendVerifyEmail(): Response
    {
        return $this->render('registration/resend_verify_email.html.twig');
    }
}

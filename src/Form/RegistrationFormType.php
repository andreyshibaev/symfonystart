<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\PasswordStrength;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class, [
                'label' => 'Ваша почта',
                'attr' => [
                    'placeholder' => 'Введите почту'
                ],
                'constraints' => [
                    new Email([
                        'mode' => 'html5',
                        'message' => 'Латинскими буквами пример `user@gmail.com`'
                    ])
                ]
            ])
            ->add('username', TextType::class, [
                'label' => 'Ваше имя',
                'attr' => [
                    'placeholder' => 'Введите имя'
                ],
                'constraints' => [
                    new Length([
                        'min' => 3
                    ])
                ]
            ])
            ->add('agreeTerms', CheckboxType::class, [
                'mapped' => false,
                'label' => 'Согласен'
            ])
            ->add('plainPassword', PasswordType::class, [
                'mapped' => false,
                'label' => 'Ваш пароль',
                'attr' => [
                    'autocomplete' => 'new-password',
                    'placeholder' => 'Введите пароль'
                ],
                'constraints' => [
                    new PasswordStrength([
                        'message' => 'Слабый пароль! Пример: `Nick#Jordan7%` > 12 знаков. Цифры, символы, заглавные и строчные буквы'
                    ])
                ],
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Зарегистрировать',
                'attr' => ['class' => 'btn_register_submit'],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}

<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RegisterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username', TextType::class, [
                'label'=>"username",
                'attr'=>[
                   'placeholder'=> "ex: joj44"
                ]
            ])
            ->add('email', EmailType::class, [
                'label'=>"Email",
                'attr'=>[
                    'placeholder'=>"ex: myEmail@email.com"
                ]
            ])
            ->add('password', PasswordType::class, [
                'label'=>"Password",
                'attr'=>[
                    'placeholder'=>"ex : j3!df29*"
                    ]
            ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}

<?php

namespace App\Form;

use App\Entity\Email;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AutreEmailType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('userEmail', TextType::class, [
                "label"=>'user Email (from)'
            ])
            ->add('sendAddress', TextType::class, [
                "label"=>'Email Address (To)'
            ])
            ->add('subject', TextType::class,[
                "label"=>'subject',
                "attr"=>[
                    'placeholder'=>'Check this out !!'
                ]
            ])
            ->add('message', TextareaType::class,[
                "label"=>"message",
                "attr"=>[
                    'placeholder'=>'add a nice word here...'
                ]
            ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Email::class,
        ]);
    }
}

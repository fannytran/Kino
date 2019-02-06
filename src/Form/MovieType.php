<?php

namespace App\Form;

use App\Entity\Movie;
use Doctrine\DBAL\Types\FloatType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class MovieType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, [
                "label"=>"title"
            ])
            ->add('image', TextType::class, [
                "label"=>"image-file"
            ])
            ->add('year',IntegerType::class,[
                "label"=>"date of release"
            ])
            ->add('genres', TextType::class, [
                "label"=>"category"
            ])
            ->add('actors', TextType::class, [
                "label"=>"actors"
            ])
            ->add('directors', TextType::class, [
                "label"=>"director"
            ])
            ->add('plot', TextareaType::class, [
                "label"=>"plot"
            ])
            ->add('rating', TextType::class, [
                "label"=>"rating"
            ])
            ->add('runtime', IntegerType::class, [
                "label"=>"runtime"
            ])
            ->add('trailerId', TextType::class, [
                "label"=>'trailerId'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Movie::class,
        ]);
    }
}

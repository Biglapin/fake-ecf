<?php

namespace App\Form;

use App\Classe\Search;
use App\Entity\Genre;
use App\Entity\Book;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SearchType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('string', TextType::class, [
                'label' => false,
                'required' => false,
                'attr' => [
                    'placeholder' => 'Votre recherche ...',
                    'class' => 'form-check mb-3'
                ]
            ])
     /*        ->add('genre', EntityType::class, [
              "choice_label" => 'name'  
              'label' => false,
              'required' => false,
              'mapped' => false,
              'class' => Genre::class,
              'multiple' => true,
              'expanded' => true, 
          ]) */
            ->add('submit', SubmitType::class, [
                'label' => 'Filtrer',
                'attr' => [
                    'class' => 'mt-3 bg-white hover:bg-gray-100 text-gray-800 font-semibold py-3 px-5 border border-gray-400 rounded shadow'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Search::class,
            'method' => 'GET',
            'crsf_protection' => false,
        ]);
    }

    public function getBlockPrefix()
    {
        return '';
    }
}
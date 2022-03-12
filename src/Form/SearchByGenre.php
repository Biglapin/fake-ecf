<?php

namespace App\Form;

use App\Entity\Genre;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SearchByGenre extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options)
  {
      $builder
          ->add('genre', EntityType::class, [
            "choice_label" => 'name',  
            'label' => false,
            'required' => false,
            'mapped' => false,
            'class' => Genre::class,
            'multiple' => true,
            'expanded' => true, 
            'attr' => [
                'class' => 'form-check-input appearance-none h-4 w-4 border border-gray-300 rounded-sm
                 bg-white checked:bg-blue-600 checked:border-blue-600 focus:outline-none transition 
                 duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer"
                 type="checkbox" value="" id="flexCheckDefault'
            ]
        ])
      ;
  }

  public function configureOptions(OptionsResolver $resolver)
  {
      $resolver->setDefaults([
          'method' => 'GET',
          'crsf_protection' => false,
      ]);
  }

  public function getBlockPrefix()
  {
      return '';
  }

}
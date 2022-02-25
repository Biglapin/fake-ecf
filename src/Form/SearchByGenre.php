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
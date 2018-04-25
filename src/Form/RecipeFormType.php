<?php

namespace App\Form;

//use App\Entity\RecipeIngredient;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RecipeFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
       /* $builder
            ->add('Name', TextType::class)
            ->add('amount')
            ->add('measurement')
        ;*/

        $builder->add('ingredients', 'collection', array(
            'type' => new RecipeIngredientType();
                'allow_add' => true;
                'allow_delete' => true;
                'prototype' => true;
                'prototype_name' => 'tag__name__'
            )
        ));
       /* $builder->add('ingredients', CollectionType::class, array(
            'selectedIngredients' => RecipeIngredient::class,
            'entry_options' => array(

            ),
            'allow_add' => true,
            'allow_delete' => true,
        ));*/
    }

    /*public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => RecipeIngredient::class,
        ]);
    }*/
}

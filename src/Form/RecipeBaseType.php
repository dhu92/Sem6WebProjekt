<?php
/**
 * Created by PhpStorm.
 * User: David
 * Date: 5/23/2018
 * Time: 11:18 AM
 */

namespace App\Form;


use App\Entity\IngredientTranslation;
use App\Entity\Language;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormTypeInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RecipeBaseType extends AbstractType{

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder

            ->add('Name')
            //    ->add("Language")
            ->add('Language', EntityType::class, array(
                'class' => Language::class,
                'choice_label' => 'name',
            ))
            ->add('ingredients', CollectionType::class, array(
                'entry_type'   => RecipeFormType::class,
                'label'        => 'List and order your ingredients by preference.',
                'allow_add'    => true,
                'allow_delete' => true,
                'prototype'    => true,
                'required'     => false,
                'attr'   =>  [
                    'class' => 'setIngredient-collection',
                ],
            ))
            ->add('submit', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'App\Entity\IngredientTranslation',
        ]);
    }
}
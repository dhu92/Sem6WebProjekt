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
use App\Entity\Recipe;
use App\Entity\RecipeBase;
use App\Entity\RecipeIngredient;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
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
            ->add('ingredient', CollectionType::class, array(
                'entry_type'   => RecipeFormType::class,
                'label'        => 'List and order your ingredients by preference.',
                'allow_add'    => true,
                'allow_delete' => true,
                'entry_options' => array('label' => false),
                'prototype'    => true,
                'required'     => false,
                'by_reference' => false,
                'attr'   =>  [
                    'class' => 'setIngredient-collection',
                ],
            ))
            ->add('Description')
            ->add('Duration')
            ->add('Preparation')
            ->add('submit', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => RecipeBase::class,
        ]);
    }

}
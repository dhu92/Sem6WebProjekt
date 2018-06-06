<?php

namespace App\Form;

use App\Entity\IngredientTranslation;
use App\Entity\Language;
use App\Entity\Recipe;
use App\Entity\RecipeForm;
use App\Entity\RecipeIngredient;
use App\Entity\RecipeTranslation;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RecipeFormType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder

            ->add('ingredients', EntityType::class, array(
                'class' => IngredientTranslation::class,
                'choice_label' => 'name',
            ))
            ->add('Amount')
            ->add('Measurement')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => RecipeIngredient::class,
        ]);
    }


}

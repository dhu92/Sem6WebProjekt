<?php

namespace App\Form;

//use App\Entity\RecipeIngredient;
use App\Entity\IngredientTranslation;
use App\Entity\Language;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\FormBuilder;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class RecipeFormType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
       /*     ->add('ingredients', IngredientSelectType::class, [
                'data' => [
                    'ingredientlist' => ['field_type' => EntityType::class,
                        'class' => 'IngredientTranslation',
                        'choice_label' => 'name',
                    ]
                ]
            ])*/
            ->add('Name')
        //    ->add("Language")
            ->add('Language', EntityType::class, array(
                'class' => Language::class,
                'choice_label' => 'name',
            ))->add('ingredients', EntityType::class, array(
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
            'data_class' => 'App\Entity\IngredientTranslation',
        ]);
    }
}

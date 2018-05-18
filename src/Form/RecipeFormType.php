<?php

namespace App\Form;

//use App\Entity\RecipeIngredient;
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
//        $builder
//            ->add('name')
//            ->add('language', EntityType::class, array(
//                'class' => Language::class,
//                'choice_label' => 'name',
//            ));

        $builder
            ->add('name', TextType::class)
            ->add('language', TextType::class);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'App\Entity\IngredientTranslation',
        ]);
    }
}

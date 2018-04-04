<?php

namespace App\Form;

//use App\Entity\IngredientTranslation;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class IngredientType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            //->add('ingredientID')
            //->add('language')
        ;

        $builder
            ->add('langauge', 'entity', [
                'class' => 'App\Entity\Language',
                'property' => 'name',
                'placeholder' => 'Select',
                'choices' => $this->choices,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => IngredientTranslation::class,
        ]);
    }
}

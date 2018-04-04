<?php

namespace App\Form;

//use App\Entity\IngredientTranslation;
use App\Entity\Language;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class IngredientType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        /*$builder

            //->add('ingredientID')
            //->add('language')
        ;*/

        $builder
            ->add('name')
            ->add('langauge', 'entity', [
                'class' => 'App\Entity\Language',
                'property' => 'name',
                'placeholder' => 'Select',
                'choices' => $this->choices,
            ]);
    }

}

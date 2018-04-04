<?php

namespace App\Form;

//use App\Entity\IngredientTranslation;
use App\Controller\LanguageController;
use App\Entity\Language;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class IngredientType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        //dropdown
        /*$builder
            ->add('name')
            ->add('language', EntityType::class, array(
            'class' => Language::class,
            'choice_label' => 'name',
        ));*/

        $builder
            ->add('Name_in_Deutsch')
            ->add('Name_in_English')
        ;
    }

}

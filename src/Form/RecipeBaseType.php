<?php
/**
 * Created by PhpStorm.
 * User: David
 * Date: 5/23/2018
 * Time: 11:18 AM
 */

namespace App\Form;


use App\Entity\Language;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
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
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'App\Entity\IngredientTranslation',
        ]);
    }
}
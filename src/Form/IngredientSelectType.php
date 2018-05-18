<?php
/**
 * Created by PhpStorm.
 * User: David
 * Date: 5/18/2018
 * Time: 11:42 AM
 */

namespace App\Form;


use App\Entity\IngredientTranslation;
use App\Entity\Language;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class IngredientSelectType extends AbstractType{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        //dropdown
        $builder
            ->add('name', EntityType::class, array(
                'class' => IngredientTranslation::class,
                'choice_label' => 'name',
            ))
            ->add('amount')
            ->add('measurement')
        ;
    }

}
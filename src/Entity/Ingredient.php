<?php
/**
 * Created by PhpStorm.
 * User: ClemensB
 * Date: 21.03.18
 * Time: 08:52
 */

namespace App\Entity;

/**
 * @ORM/Table(name="Ingredient")
 * @ORM/Entity
 */
class Ingredient
{
    /**
     * @ORM/Column(type="integer")
     * @ORM/GeneratedValue
     * @ORM/id
     */
    private $id;

    /**
     * @OneToMany(targetEntity="IngredientTranslation")
     * @JoinColumn(name="id", referencedColumnName="recipeID")
     */
    private $translation;
}
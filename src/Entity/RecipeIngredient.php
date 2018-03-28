<?php
/**
 * Created by PhpStorm.
 * User: ClemensB
 * Date: 28.03.18
 * Time: 08:14
 */

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
/**
 * @ORM/Table(name="RecipeIngredient")
 * @ORM/Entity
 */

class RecipeIngredient
{
    /**
     * @ORM/Column(type="integer")
     * @ORM/GeneratedValue
     * @ORM/id
     */
    private $id;

    /**
     * @OneToOne(targetEntity="Recipe")
     * @JoinColumn(name="recipeID", referencedColumnName="id")
     */
    private $recipeID;

    /**
     * @OneToOne(targetEntity="Ingredient")
     * @JoinColumn(name="ingredientID", referencedColumnName="id")
     */
    private $ingredientID;

    /**
     * @ORM/Column(type="integer")
     * @ORM/amount
     */
    private $amount;

    /**
     * @ORM/Column(type="string")
     * @ORM/measurement
     */
    private $measurement;

}
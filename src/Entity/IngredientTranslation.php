<?php
/**
 * Created by PhpStorm.
 * User: David
 * Date: 3/28/2018
 * Time: 8:37 AM
 */

namespace App\Entity;

/**
 * @ORM/Table(name="IngredientTranslation")
 * @ORM/Entity
 */
class IngredientTranslation {

    /**
     * @ORM/Column(type="integer")
     * @ORM/GeneratedValue
     * @ORM/id
     */
    private $id;

    /**
     * @ManyToOne(targetEntity="Ingredient")
     * @JoinColumn(name="ingredientID", referencedColumnName="id")
     */
    private $ingredientID;

    /**
     * @ORM/Column(type="string")
     * @ORM/name
     */
    private $name;

    /**
     * @OneToOne(targetEntity="Language")
     * @JoinColumn(name="id", referencedColumnName="id")
     */
    private $language;
}
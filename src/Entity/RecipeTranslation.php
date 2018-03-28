<?php
/**
 * Created by PhpStorm.
 * User: David
 * Date: 3/28/2018
 * Time: 8:19 AM
 */

namespace App\Entity;

/**
 * @ORM/Table(name="RecipeTranslation")
 * @ORM/Entity
 */
class RecipeTranslation {


    /**
     * @ORM/Column(type="integer")
     * @ORM/GeneratedValue
     * @ORM/id
     */
    private $id;

    /**
     * @OneToOne(targetEntity="Language")
     * @JoinColumn(name="languageID", referencedColumnName="id")
     */
    private $languageID;

    /**
     * @ManyToOne(targetEntity="Recipe")
     * @JoinColumn(name="recipeID", referencedColumnName="id")
     */
    private $recipeID;

    /**
     * @ORM/Column(type="string")
     * @ORM/name
     */
    private $name;

    /**
     * @ORM/Column(type="string")
     * @ORM/description
     */
    private $description;

    /**
     * @ORM/Column(type="string")
     * @ORM/preperation
     */
    private $preperation;

    /**
     * @ORM/Column(type="integer")
     * @ORM/duration
     */
    private $duration;
}
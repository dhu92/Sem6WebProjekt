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
    private $name;
    private $description;
    private $preperation;
    private $duration;
    private $language;

}
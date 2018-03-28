<?php
/**
 * Created by PhpStorm.
 * User: ClemensB
 * Date: 21.03.18
 * Time: 08:52
 */

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
/**
 * @ORM\Table(name="Ingredient")
 * @ORM\Entity
 */
class Ingredient
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     * @ORM\Id
     */
    private $id;

    /**
     * @ORM\OneToMany(targetEntity="IngredientTranslation")
     * @ORM\JoinColumn(name="id", referencedColumnName="recipeID")
     */
    private $translation;
}
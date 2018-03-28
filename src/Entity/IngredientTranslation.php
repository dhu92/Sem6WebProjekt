<?php
/**
 * Created by PhpStorm.
 * User: David
 * Date: 3/28/2018
 * Time: 8:37 AM
 */

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
/**
 * @ORM\Table(name="IngredientTranslation")
 * @ORM\Entity
 */
class IngredientTranslation {

    /**
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     * @ORM\Id
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Ingredient")
     * @ORM\JoinColumn(name="ingredientID", referencedColumnName="id")
     */
    private $ingredientID;

    /**
     * @ORM\Column(type="string")
     */
    private $name;

    /**
     * @ORM\OneToOne(targetEntity="Language", mappedBy="Language")
     * @ORM\JoinColumn(name="id", referencedColumnName="id")
     */
    private $language;
}
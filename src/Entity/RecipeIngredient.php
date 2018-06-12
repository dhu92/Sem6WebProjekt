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
 * @ORM\Table(name="RecipeIngredient")
 * @ORM\Entity
 */

class RecipeIngredient
{


    public $ingredients;

    /**
     * @return mixed
     */
    public function getIngredients()
    {
        return $this->ingredients;
    }

    /**
     * @param mixed $ingredients
     */
    public function setIngredients($ingredients): void
    {
        $this->ingredients = $ingredients;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getRecipeID()
    {
        return $this->recipeID;
    }

    /**
     * @param mixed $recipeID
     */
    public function setRecipeID($recipeID): void
    {
        $this->recipeID = $recipeID;
    }

    /**
     * @return mixed
     */
    public function getIngredientID()
    {
        return $this->ingredientID;
    }

    /**
     * @param mixed $ingredientID
     */
    public function setIngredientID($ingredientID): void
    {
        $this->ingredientID = $ingredientID;
    }

    /**
     * @return mixed
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @param mixed $amount
     */
    public function setAmount($amount): void
    {
        $this->amount = $amount;
    }

    /**
     * @return mixed
     */
    public function getMeasurement()
    {
        return $this->measurement;
    }

    /**
     * @param mixed $measurement
     */
    public function setMeasurement($measurement): void
    {
        $this->measurement = $measurement;
    }
    /**
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     * @ORM\Id
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Recipe")
     * @ORM\JoinColumn(name="recipeID", referencedColumnName="id", onDelete="CASCADE")
     */
    private $recipeID;

    /**
     * @ORM\ManyToOne(targetEntity="Ingredient")
     * @ORM\JoinColumn(name="ingredientID", referencedColumnName="id")
     */
    private $ingredientID;

    /**
     * @ORM\Column(type="integer")
     */
    private $amount;

    /**
     * @ORM\Column(type="string")
     */
    private $measurement;

}
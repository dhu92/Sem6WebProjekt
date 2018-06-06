<?php
/**
 * Created by PhpStorm.
 * User: bauer
 * Date: 06.06.2018
 * Time: 10:02
 */

namespace App\Entity;


use Doctrine\Common\Collections\ArrayCollection;

class RecipeBase
{
    protected $name;
    protected $language;
    protected $ingredient;
    protected $description;
    protected $duration;
    protected $preparation;

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description): void
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getDuration()
    {
        return $this->duration;
    }

    /**
     * @param mixed $duration
     */
    public function setDuration($duration): void
    {
        $this->duration = $duration;
    }

    /**
     * @return mixed
     */
    public function getPreparation()
    {
        return $this->preparation;
    }

    /**
     * @param mixed $preparation
     */
    public function setPreparation($preparation): void
    {
        $this->preparation = $preparation;
    }

    public function __construct()
    {
        $this->ingredient = new ArrayCollection();
    }

    /**
     * @return ArrayCollection
     */
    public function getIngredient(): ArrayCollection
    {
        return $this->ingredient;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name): void
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * @param mixed $language
     */
    public function setLanguage($language): void
    {
        $this->language = $language;
    }

    public function addIngredient(RecipeIngredient $ingredientTranslation){
        $this->ingredient->add($ingredientTranslation);
    }

    public function removeIngredient(RecipeIngredient $ingredientTranslation){
        $this->ingredient->removeElement($ingredientTranslation);
    }
}
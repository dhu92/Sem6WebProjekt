<?php
/**
 * Created by PhpStorm.
 * User: David
 * Date: 3/28/2018
 * Time: 8:19 AM
 */

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
/**
 * @ORM\Table(name="RecipeTranslation")
 * @ORM\Entity
 */
class RecipeTranslation {
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
    public function getLanguageID()
    {
        return $this->languageID;
    }

    /**
     * @param mixed $languageID
     */
    public function setLanguageID($languageID): void
    {
        $this->languageID = $languageID;
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
    public function getPreperation()
    {
        return $this->preperation;
    }

    /**
     * @param mixed $preperation
     */
    public function setPreperation($preperation): void
    {
        $this->preperation = $preperation;
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
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     * @ORM\Id
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Language")
     * @ORM\JoinColumn(name="languageID", referencedColumnName="id")
     */
    private $languageID;

    /**
     * @ORM\ManyToOne(targetEntity="Recipe")
     * @ORM\JoinColumn(name="recipeID", referencedColumnName="id")
     */
    private $recipeID;

    /**
     * @ORM\Column(type="string")
     */
    private $name;

    /**
     * @ORM\Column(type="string")
     */
    private $description;

    /**
     * @ORM\Column(type="string")
     */
    private $preperation;

    /**
     * @ORM\Column(type="integer")
     */
    private $duration;

    public function belongsTo($id){
        if($this->getId() == $id){
            return true;
        }
        return false;
    }
}
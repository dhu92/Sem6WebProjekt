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
     * @ORM\JoinColumn(name="languageid", referencedColumnName="id")
     */
    private $language;
}
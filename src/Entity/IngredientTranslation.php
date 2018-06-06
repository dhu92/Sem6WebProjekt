<?php
/**
 * Created by PhpStorm.
 * User: David
 * Date: 3/28/2018
 * Time: 8:37 AM
 */

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Form\FormTypeInterface;

/**
 * @ORM\Table(name="IngredientTranslation")
 * @ORM\Entity
 */
class IngredientTranslation {

    public $collection;



    public function getIngredients() : Collection{
        $test1 = new IngredientTranslation();
        $test1->setName("");
        $collection = new ArrayCollection();
        $collection->add($test1);
        return $collection;
    }

    public function setLoadedIngredients($allingredients){
        $this->collection = $allingredients;
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
     * @ORM\ManyToOne(targetEntity="Language")
     * @ORM\JoinColumn(name="languageID", referencedColumnName="id")
     */
    private $language;


}
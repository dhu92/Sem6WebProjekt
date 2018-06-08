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
 * @ORM\Table(name="Recipe")
 * @ORM\Entity
 */
class Recipe
{
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
     * @param mixed $owner
     */
    public function setOwner($owner){
        $this->owner = $owner;
    }

    /**
     * @return mixed
     */
    public function getOwner(){
        return $this->owner;
    }
//    /**
//     * @return mixed
//     */
//    public function getTranslation()
//    {
//        return $this->translation;
//    }
//
//    /**
//     * @param mixed $translation
//     */
//    public function setTranslation($translation): void
//    {
//        $this->translation = $translation;
//    }

    /**
     *
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     * @ORM\Id
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumn(name="owner", referencedColumnName="id")
     */
    private $owner;

//    /**
//     * @ORM\OneToOne(targetEntity="RecipeTranslation", mappedBy="RecipeTranslation")
//     * @ORM\JoinColumn(name="id", referencedColumnName="recipeID")
//     */
//    private $translation;

    public function toString() {
        return strval($this->getId());
    }

}
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

    /*public function getClass(){
        return Ingredient::class;
    }*/
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

   /* /**
     * @return mixed
     */
    /*public function getTranslation()
    {
        return $this->translation;
    }

    /**
     * @param mixed $translation
     */
    /*public function setTranslation($translation): void
    {
        $this->translation = $translation;
    }*/

    /**
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     * @ORM\Id
     */
    private $id;
/*
    /**
     * @ORM\ManyToOne(targetEntity="IngredientTranslation")
     * @ORM\JoinColumn(name="translationId", referencedColumnName="id")
     */
//    private $translation;

}
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
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     * @ORM\Id
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity="Language", mappedBy="Language")
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
}
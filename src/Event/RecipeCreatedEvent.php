<?php
/**
 * Created by PhpStorm.
 * User: bauer
 * Date: 23.05.2018
 * Time: 08:45
 */

namespace App\Event;


use App\Entity\Recipe;
use Symfony\Component\EventDispatcher\Event;

class RecipeCreatedEvent extends Event
{
    const NAME = 'recipe.created';

    protected $recipe;

    public function __construct(Recipe $recipeTo)
    {
        $this->recipe = (string)$recipeTo->getId();
    }

    /**
     * @return mixed
     */
    public function getRecipe()
    {
        return $this->recipe;
    }

}
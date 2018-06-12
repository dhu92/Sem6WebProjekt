<?php

namespace App\Controller;

use App\Entity\Recipe;
use App\Entity\RecipeTranslation;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class RecipeListController extends Controller
{

    /**
     * @Route("/recipe/getAll", name="recipe_list")
     */
    public function index()
    {
        $recipeTranslations = array();

        $recipe = $this->getDoctrine()
            ->getRepository(Recipe::class)
            ->findAll();

        dump($recipe);

        for ($x = 0; $x < sizeof($recipe); $x++){
            $recipeTranslation = $this->getDoctrine()
                ->getRepository(RecipeTranslation::class)
                ->findByRecipeID($recipe[$x]->getID());
            $recipeTranslations[$x] = $recipeTranslation;
        }

        dump($recipeTranslations);

        return $this->render('recipe_list/index.html.twig',
            array('recipeTranslations' => $recipeTranslations));
    }
}

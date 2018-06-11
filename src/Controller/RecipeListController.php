<?php

namespace App\Controller;

use App\Entity\Recipe;
use App\Entity\RecipeTranslation;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class RecipeListController extends Controller
{

    private $recipe;

    /**
     * @Route("/recipe/getAll", name="recipe_list")
     */
    public function index()
    {
        $recipeTranslations = array();

        $recipe = $this->getDoctrine()
            ->getRepository(Recipe::class)
            ->findAll();

        for ($x = 1; $x <= sizeof($recipe); $x++){
            $recipeTranslation = $this->getDoctrine()
                ->getRepository(RecipeTranslation::class)
                ->findByRecipeID($x);
            $recipeTranslations[$x] = $recipeTranslation;
        }

        dump($recipeTranslations);


        return $this->render('recipe_list/index.html.twig',
            array('recipeTranslations' => $recipeTranslations));
    }
}

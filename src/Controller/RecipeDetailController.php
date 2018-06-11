<?php

namespace App\Controller;

use App\Entity\Ingredient;
use App\Entity\IngredientTranslation;
use App\Entity\Language;
use App\Entity\Recipe;
use App\Entity\RecipeIngredient;
use App\Entity\RecipeTranslation;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class RecipeDetailController extends Controller
{


    /**
     * @Route("/recipe/get/{id}", name="recipe_detail")
     */
    public function index($id)
    {
        $ingredients = array();

        $recipe = $this->getRecipes($id);

        $recipeTranslation = $this->getDoctrine()
            ->getRepository(RecipeTranslation::class)
            ->findByRecipeID($id);

        dump($recipeTranslation);

        $recipeIngredients = $this->getDoctrine()
            ->getRepository(RecipeIngredient::class)
            ->findByRecipeID($id);

        $language = $this->getDoctrine()
            ->getRepository(Language::class)
            ->find(1);

        dump($language);

        for ($x = 0; $x < sizeof($recipeIngredients); $x++) {
            $ingredientForTranslation[$x] = $this->getDoctrine()
                ->getRepository(Ingredient::class)
                ->find($recipeIngredients[$x]->getIngredientID());
        }

        for ($y = 0; $y < sizeof($recipeIngredients); $y++) {
            $ingredient = $this->getDoctrine()
                ->getRepository(IngredientTranslation::class)
                ->findByIngredientID($ingredientForTranslation[$y]);
            dump($ingredientForTranslation[$y]);
            $ingredients = $ingredient;
        }

        dump($ingredients);

        return $this->render('recipe_detail/index.html.twig', [
            'controller_name' => 'RecipeDetailController',
        ]);
    }

    private function getRecipes($id) {
        $recipe = $this->getDoctrine()
            ->getRepository(Recipe::class)
            ->find($id);

        dump($recipe);
    }


}

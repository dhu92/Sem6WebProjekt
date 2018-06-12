<?php

namespace App\Controller;

use App\Entity\Ingredient;
use App\Entity\IngredientTranslation;
use App\Entity\Language;
use App\Entity\Recipe;
use App\Entity\RecipeBase;
use App\Entity\RecipeIngredient;
use App\Entity\RecipeTranslation;
use App\Form\RecipeBaseType;
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

        $recipeBase = new RecipeBase();
        $recipeBase->setLanguage($language);
        $recipeBase->setDuration($recipeTranslation[0]->getDuration());
        $recipeBase->setDescription($recipeTranslation[0]->getDescription());
        $recipeBase->setName($recipeTranslation[0]->getName());
        $recipeBase->setPreparation($recipeTranslation[0]->getPreperation());
        foreach ($ingredients as $ing){
            $recipeBase->addIngredient($ing);
        }
        $baseForm = $this->createForm(RecipeBaseType::class, $recipeBase);




        return $this->render('recipe_detail/index.html.twig', [
            'controller_name' => 'RecipeDetailController',
            'recipe_form' => $baseForm->createView()

        ]);
    }

    private function getRecipes($id) {
        $recipe = $this->getDoctrine()
            ->getRepository(Recipe::class)
            ->find($id);

        dump($recipe);
    }


}

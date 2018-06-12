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
use Symfony\Component\HttpFoundation\Request;


class RecipeDetailController extends Controller
{


    /**
     * @Route("/recipe/get/{id}", name="recipe_detail")
     */
    public function index($id, Request $request)
    {
        $ingredients = array();

        $recipe = $this->getDoctrine()
            ->getRepository(Recipe::class)
            ->find($id);
        $recipeTranslation = $this->getDoctrine()
            ->getRepository(RecipeTranslation::class)
            ->findByRecipeID($id);


        $recipeIngredients = $this->getDoctrine()
            ->getRepository(RecipeIngredient::class)
            ->findByRecipeID($id);

        $language = $this->getDoctrine()
            ->getRepository(Language::class)
            ->find(1);


        for ($x = 0; $x < sizeof($recipeIngredients); $x++) {
            $ingredientForTranslation[$x] = $this->getDoctrine()
                ->getRepository(Ingredient::class)
                ->find($recipeIngredients[$x]->getIngredientID());
        }

        for ($y = 0; $y < sizeof($recipeIngredients); $y++) {
            $ingredients = $this->getDoctrine()
                ->getRepository(RecipeIngredient::class)
                ->findByIngredientID($ingredientForTranslation[$y]);
        }

        dump($ingredientForTranslation);

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
        $baseForm->handleRequest($request);


        if($baseForm->isSubmitted()){
            if($this->getUser()->getId() != $recipe->getOwner()->getId()){
                $this->addFlash('failure', 'You are not allowed to edit recipeies from other users.');
            } else {
                dump("isSubmitted true");
                $baseFormData = $baseForm->getData();
                $this->addFlash('success', 'Recipe added successfully');
                $this->save($baseFormData, $recipe);
                $this->redirectToRoute('recipe_ingredient');
            }
        }



        return $this->render('recipe_detail/index.html.twig', [
            'controller_name' => 'RecipeDetailController',
            'recipe_form' => $baseForm->createView()
        ]);
    }

    private function getRecipes($id) {
        $recipe = $this->getDoctrine()
            ->getRepository(Recipe::class)
            ->find($id);
    }

    private function save($data, $recipe){
        //save new recipe in Table recipe
        dump($data);
        $entityManager = $this ->getDoctrine()->getManager();
        $entityManager->persist($recipe);
        $entityManager->flush();

        //save ingrediants
        $elements = $data->getIngredient();
        foreach($elements as  $recipeIngredient){
            foreach($recipeIngredient as $ingredient){
                $recipeIngredient->setIngredientID($ingredient->getIngredientID());
                $recipeIngredient->setRecipeID($recipe);
                $entityManager = $this ->getDoctrine()->getManager();
                $entityManager->persist($recipeIngredient);
                $entityManager->flush();
            }
        }

        //save translation
        $recipeTranslation = new RecipeTranslation();
        $recipeTranslation->setLanguageID($data->getLanguage());
        $recipeTranslation->setName($data->getName());
        $recipeTranslation->setDescription($data->getDescription());
        $recipeTranslation->setDuration($data->getDuration());
        $recipeTranslation->setPreperation($data->getPreparation());
        $recipeTranslation->setRecipeID($recipe);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($recipeTranslation);
        $entityManager->flush();

    }


}

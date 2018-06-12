<?php
/**
 * Created by PhpStorm.
 * User: David
 * Date: 6/6/2018
 * Time: 4:07 PM
 */

namespace App\Controller;


use App\Entity\Language;
use App\Entity\Recipe;
use App\Entity\RecipeIngredient;
use App\Entity\RecipeTranslation;
use App\Entity\User;
use App\Exception\RecipeNotFoundException;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\View\View;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class RestController extends FOSRestController{

    /**
     * @Rest\Get("/api/recipe/getall")
     */
    public function getRecipes(): View
    {
        $result = $this->getDoctrine()->getRepository(Recipe::class)->findAll();
//        $translations = [];
//        foreach($result as $recipe){
//            $translationsForRecipe = $this->loadTranslationsFromDatabase($recipe);
//            foreach($translationsForRecipe as $translation){
//                array_push($translations, $translation);
//            }
//        }
        return View::create($result, Response::HTTP_OK);
    }

    /**
     * @Rest\Get("api/recipe/gettranslations/{recipeId}")
     * @param int $recipeId
     * @return View
     */
    public function findTranslationsForRecipe(int $recipeId){
        $recipe = $this->getDoctrine()->getRepository(Recipe::class)->find($recipeId);
        $result = [];
        if (!empty($recipe)) {
            $result = $this->loadTranslationsFromDatabase($recipe);
        }
        return View::create($result, Response::HTTP_OK);
    }

    /**
     * @Rest\Get("api/recipe/getowner/{recipeId}")
     * @param int $recipeId
     * @return View
     */
    public function getOwnerForRecipe($recipeId){
        $recipe = $this->getDoctrine()->getRepository(Recipe::class)->find($recipeId);
        $owner = $this->getDoctrine()->getRepository(User::class)->find($recipe->getOwner()->getId());
        return View::create($owner, Response::HTTP_OK);
    }

    /**
     * @Rest\Get("api/recipe/getbyowner/{ownerId}")
     * @param int $ownerId
     * @return View
     */
    public function getRecipesByOwner($ownerId){
        $recipes = $this->getDoctrine()->getRepository(Recipe::class)->findAll();
        $result = [];
        foreach($recipes as $recipe){
            if($recipe->getOwner()->getId() == $ownerId){
                array_push($result, $recipe);
            }
        }
        return View::create($result, Response::HTTP_OK);
    }

    /**
     * @Rest\Get("/api/recipe/{recipeId}")
     * @param $recipeId
     * @return View
     * @throws RecipeNotFoundException
     */
    public function getRecipeById(int $recipeId){
        $recipe = $this->getDoctrine()->getRepository(Recipe::class)->find($recipeId);
//        $translations = $this->findTranslationsForRecipe($recipe);
        if(!$recipe){
            throw new RecipeNotFoundException();
        }
        return View::create($recipe, Response::HTTP_OK);
    }

    /**
     * Create a recipe
     * @Rest\Post("/api/recipe/create")
     * @param Request $request
     * @return View
     */
    public function createRecipe(Request $request){
        $entityManager = $this->getDoctrine()->getManager();
        $translation = new RecipeTranslation();
//        if($request->query->has('name')) {
            $translation->setName($request->get('name'));
            $translation->setDescription($request->get('description'));
            $translation->setDuration($request->get('duration'));
            $translation->setLanguageID($this->getDoctrine()->getRepository(Language::class)->find($request->get('languageID')));
            $translation->setPreperation($request->get('preperation'));
//        }
        if($request->get('recipeID')){
            $translation->setRecipeID($this->getDoctrine()->getRepository(Recipe::class)->find($request->get('recipeID')));
        } else {
            $newRecipe = new Recipe();
            $newRecipe->setOwner($this->getDoctrine()->getRepository(User::class)->find($request->get("userID")));
            $entityManager->persist($newRecipe);
            $entityManager->flush();
            $translation->setRecipeID($newRecipe);
        }
        $entityManager->persist($translation);
        $entityManager->flush();
        return View::create("Recipe created", Response::HTTP_OK);
    }

    /**
     * Update a recipe
     * @Rest\Put("/api/recipe/update")
     * @param Request $request
     * @return View
     */
    public function updateRecipe(Request $request){
        $recipe = $this->getDoctrine()->getRepository(Recipe::class)->find($request->get('recipeID'));
        $recipe->setOwner($this->getDoctrine()->getRepository(User::class)->find($request->get('owner')));
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($recipe);
        $entityManager->flush();
        return View::create("Recipe updated.", Response::HTTP_OK);
    }

    /**
     * Delete a recipe
     * @Rest\Delete("/api/recipe/delete")
     * @param Request $request
     * @return View
     */
    public function deleteRecipe(Request $request){
        $recipe = $this->getDoctrine()->getRepository(Recipe::class)->find($request->get('recipeID'));
//        $translations = $this->findTranslationsForRecipe($recipe->getId());
//        $translations = $this->loadTranslationsFromDatabase($recipe);
//        $count = sizeof($translations);
//        $message = "";
//        $recipeIngredients = $this->getDoctrine()->getRepository(RecipeIngredient::class)->findAll();
//        foreach($recipeIngredients as $ri){
//            if($ri->getRecipeID() == $recipe){
//                $this->getDoctrine()->getManager()->remove($ri);
//            }
//        }
//        $x = 0;
//        foreach($translations as $translation){
//            $this->getDoctrine()->getManager()->remove($translation);
//            $x++;
//        }
        $message = "Nothing deleted";
        if($recipe){
            $this->getDoctrine()->getManager()->remove($recipe);
            $message = "Recipe deleted";
        }
//        $message = $message . " and " .$x . "/". $count . " related translations.";
        return View::create($message, Response::HTTP_OK);
    }

    private function loadTranslationsFromDatabase(Recipe $recipe) : array {
        $translations = $this->getDoctrine()->getRepository(RecipeTranslation::class)->findAll();
        $result = [];
        foreach($translations as $translation){
            if($translation->belongsTo($recipe)){
                array_push($result, $translation);
            }
        }
        return $result;
    }
}
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
     * Send back a user as test
     * @Rest\Get("/api/recipe/getall")
     */
    public function getRecipes(): View
    {
//        $user1 = new User();
//        $user1->setUsername("Mr. FBI Man");
//        $user1->setPassword("Superstrong password");
//        $user2 = new User();
//        $user2->setUsername("Mr. NSA Man");
//        $user2->setPassword("Even strong password");
//        $users = array($user1, $user2);
        $allrecipes = $this->getDoctrine()->getRepository(Recipe::class)->findAll();
        $allrecipeTranslations = $this->getDoctrine()->getRepository(RecipeTranslation::class)->findAll();
        $result = array();
        foreach($allrecipes as $recipe){
//            foreach($allrecipeTranslations as $translation){
//                if($translation->getRecipeID() == $recipe->getId()){
//                    array_push($result, $translation);
//                }
                array_push($result, $this->findTranslationsForRecipe($recipe));
            }
        return View::create($result, Response::HTTP_OK);
    }

    private function findTranslationsForRecipe($recipe){
        $allrecipesTranslations = $this->getDoctrine()->getRepository(RecipeTranslation::class)->findAll();
        $result = array();
        foreach($allrecipesTranslations as $translation){
//            if($translation->getRecipeID() == $recipe->getId()){
             if($translation->belongsTo($recipe->getId())){
                array_push($result, $translation);
            }
        }
        return $result;
    }

    /**
     * @Rest\Get("/api/recipe/{recipeId}")
     * @param $recipeId
     * @return View
     * @throws RecipeNotFoundException
     */
    public function getRecipeById(int $recipeId){
        $recipe = $this->getDoctrine()->getRepository(Recipe::class)->find($recipeId);
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
        $translation->setName($request->get('name'));
        $translation->setDescription($request->get('description'));
        $translation->setDuration($request->get('duration'));
        $translation->setLanguageID($this->getDoctrine()->getRepository(Language::class)->find($request->get('languageID')));
        $translation->setPreperation($request->get('preperation'));
        if($request->query->has('recipeID')){
            $translation->setRecipeID($this->getDoctrine()->getRepository(Recipe::class)->find($request->get('recipeID')));
        } else {
            $newRecipe = new Recipe();
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
     * @Rest\Put("/api/recipe/update/{recipeId}")
     * @param int $recipeId
     * @param Request $request
     * @return View
     */
    public function updateRecipe(int $recipeId, Request $request){
        $recipe = $this->getDoctrine()->getRepository(Recipe::class)->find($recipeId);
        //Update und so;
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($recipe);
        $entityManager->flush();
        return View::create("Recipe updated.", Response::HTTP_OK);
    }

    /**
     * Delete a recipe
     * @Rest\Delete("/api/recipe/delete/{recipeId}")
     * @param $recipeId
     * @return View
     */
    public function deleteRecipe(int $recipeId){
        $recipe = $this->getDoctrine()->getRepository(Recipe::class)->find($recipeId);
        $translations = $this->findTranslationsForRecipe($recipe);
        if($recipe){
            $this->getDoctrine()->getManager()->remove($recipe);
        }
        foreach($translations as $translation){
            $this->getDoctrine()->getManager()->remove($translation);
        }
        return View::create("Recipe deleted", Response::HTTP_OK);
    }
}
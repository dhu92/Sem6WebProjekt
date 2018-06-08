<?php
/**
 * Created by PhpStorm.
 * User: David
 * Date: 6/6/2018
 * Time: 4:07 PM
 */

namespace App\Controller;


use App\Entity\Recipe;
use App\Entity\RecipeTranslation;
use App\Entity\User;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\View\View;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class RestController extends FOSRestController{

    /**
     * Send back a user as test
     * @Rest\Get("/api/recipes")
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
            foreach($allrecipeTranslations as $translation){
                if($translation->getRecipeID() == $recipe->getId()){
                    array_push($result, $translation);
                }
            }
        }
        return View::create($result, Response::HTTP_OK);
    }

    /**
     * @Rest\Get("/api/recipe/{recipeId}")
     * @param $recipeId
     */
    public function getRecipeById($recipeId){
        $recipe = $this->getDoctrine()->getRepository(Recipe::class)->find($recipeId);
        return View::create($recipe, Response::HTTP_OK);
    }

    /**
     * Create a recipe
     * @Rest\Post("/api/createRecipe")
     */
    public function createRecipe(){
        dump("YAAAAAAAAAAAAAAAAAAAY");
        $entityManager = $this->getDoctrine()->getManager();
    }

    /**
     * Update a recipe
     * @Rest\Put("/api/updateRecipe/{recipeId}")
     */
    public function updateRecipe($recipeId){
        $recipe = $this->getDoctrine()->getRepository(Recipe::class)->find($recipeId);
        //Update und so;
        $this->getDoctrine()->getManager()->persist($recipe);
        $this->getDoctrine()->getManager()->flush();
    }
    /**
     * Delete a recipe
     * @Rest\Delete("/api/deleterecipe/{recipeId]")
     * @param $recipeId
     */
    public function deleteRecipe($recipeId){
        $recipe = $this->getDoctrine()->getRepository(Recipe::class)->find($recipeId);
        if($recipe){
            $this->getDoctrine()->getManager()->remove($recipe);
        }
    }
}
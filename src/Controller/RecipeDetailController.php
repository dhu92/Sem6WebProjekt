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
//        $ingredients = array();

        $recipe = $this->getDoctrine()
            ->getRepository(Recipe::class)
            ->find($id);
        $recipeTranslation = $this->getDoctrine()
            ->getRepository(RecipeTranslation::class)
            ->findByRecipeID($id);

        $recipeIngredients = $this->getDoctrine()
            ->getRepository(RecipeIngredient::class)
            ->findByRecipeID($id);
//        dump($recipeIngredients);

        $language = $this->getDoctrine()
            ->getRepository(Language::class)
            ->find($recipeTranslation[0]->getLanguageID());

        $recipeBase = new RecipeBase();
        $recipeBase->setLanguage($language);
        $recipeBase->setDuration($recipeTranslation[0]->getDuration());
        $recipeBase->setDescription($recipeTranslation[0]->getDescription());
        $recipeBase->setName($recipeTranslation[0]->getName());
        $recipeBase->setPreparation($recipeTranslation[0]->getPreperation());
        foreach ($recipeIngredients as $ing){
            $recipeBase->addIngredient($ing);
        }


        $baseForm = $this->createForm(RecipeBaseType::class, $recipeBase);

//        $data = $baseForm->getData();
//        $ingredientList = $data->getIngredient();
//        foreach($ingredientList as $ingredient){
//            $ingredient->getIngredients()->setData($recipeIngredients[1]);
//        }
////        $elements = $data->getIngredient();
//        foreach($elements as $recipeIngredient){
//            foreach($recipeIngredient as $ingredient){
//                $recipeIngredient->setIngredientID($ingredient->getIngredientID());
//                $recipeIngredient->setRecipeID($recipe);
//                $entityManager = $this ->getDoctrine()->getManager();
//                $entityManager->persist($recipeIngredient);
//                $entityManager->flush();
//            }
//      }

        $baseForm->handleRequest($request);


        if($baseForm->isSubmitted()){
            if($this->getUser()->getId() != $recipe->getOwner()->getId()){
                $this->addFlash('failure', 'You are not allowed to edit recipeies from other users.');
            } else {
//                dump("isSubmitted true");
                $baseFormData = $baseForm->getData();
                $this->addFlash('success', 'Recipe added successfully');
//                dump($baseFormData);
                $this->save($baseFormData, $recipe, $recipeTranslation[0]);
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

    private function save($data, $recipe, $recipeTranslation){

        $entityManager = $this ->getDoctrine()->getManager();
        $entityManager->persist($recipe);
        $entityManager->flush();

        $recipeIngredients = $this->getDoctrine()->getRepository(RecipeIngredient::class)->findAll();
        foreach($recipeIngredients as $ri){
            if($ri->getRecipeID() == $recipe){
                $entityManager->remove($ri);
            }
        }

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

        //save ingrediants
//        $elements = $data->getIngredient();
//        foreach($elements as  $recipeIngredient){
//            foreach($recipeIngredient as $ingredient){
//                $recipeIngredient->setIngredientID($ingredient->getIngredientID());
//                $recipeIngredient->setRecipeID($recipe);
//                $entityManager = $this ->getDoctrine()->getManager();
//                $entityManager->persist($recipeIngredient);
//                $entityManager->flush();
//            }
//        }

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

<?php

namespace App\Controller;

use App\Form\RecipeFormType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class RecipeIngredientController extends Controller
{
    /**
     * @Route("/recipe/ingredient", name="recipe_ingredient")
     */
    public function index(Request $request)
    {
        $form = $this->createForm(RecipeFormType::class);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            //anstelle von recipeData die Entity verwenden um Daten in die DB zu schreiben
            //hier könnte z.b. mit recipeData[name] auf den Namen zugegriffen werden
            $recipeData = $form->getData();

            //dump funktioniert wie sysout nur zeigt es die Informationen direkt auf der Seite an
            //dump($recipeData);

            $this->addFlash('success', 'Recipe added successfully');

            return $this->redirectToRoute('recipe_ingredient');
        }

        return $this->render('recipe_ingredient/index.html.twig', [
            'controller_name' => 'RecipeIngredientController',
            'recipe_form' => $form->createView()
        ]);
    }
}

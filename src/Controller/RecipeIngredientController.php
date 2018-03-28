<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class RecipeIngredientController extends Controller
{
    /**
     * @Route("/recipe/ingredient", name="recipe_ingredient")
     */
    public function index()
    {
        return $this->render('recipe_ingredient/index.html.twig', [
            'controller_name' => 'RecipeIngredientController',
        ]);
    }
}

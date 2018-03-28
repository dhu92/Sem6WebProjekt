<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class RecipeTranslationController extends Controller
{
    /**
     * @Route("/recipe/translation", name="recipe_translation")
     */
    public function index()
    {
        return $this->render('recipe_translation/index.html.twig', [
            'controller_name' => 'RecipeTranslationController',
        ]);
    }
}

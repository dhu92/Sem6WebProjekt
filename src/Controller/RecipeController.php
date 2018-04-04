<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class RecipeController extends Controller
{
    /**
     * @Route("/recipe", name="recipe")
     */
    public function index()
    {
        return $this->render('recipe/index.html.twig', [
            'controller_name' => 'RecipeController',
        ]);
    }

    private function save($data){
        $entityManager = $this ->getDoctrine()->getManager();
        $entityManager->persist($data);
        $entityManager->flush();
    }
}

<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class IngredientTranslationController extends Controller
{
    /**
     * @Route("/ingredient/translation", name="ingredient_translation")
     */
    public function index()
    {
        return $this->render('ingredient_translation/index.html.twig', [
            'controller_name' => 'IngredientTranslationController',
        ]);
    }

    private function save($data){
        $entityManager = $this ->getDoctrine()->getManager();
        $entityManager->persist($data);
        $entityManager->flush();
    }
}

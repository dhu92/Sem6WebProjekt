<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class IngredientController extends Controller
{
    /**
     * @Route("/ingredient", name="ingredient")
     */
    public function index()
    {

        $form = $this->createForm(RecipeFormType::class);

        $form->handleRequest($request);


        return $this->render('ingredient/index.html.twig', [
            'controller_name' => 'IngredientController',
        ]);
    }

    private function save($data){
        $entityManager = $this ->getDoctrine()->getManager();
        $entityManager->persist($data);
        $entityManager->flush();
    }
}

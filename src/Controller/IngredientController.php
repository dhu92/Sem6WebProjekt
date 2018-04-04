<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class IngredientController extends Controller
{
    /**
     * @Route("/ingredient", name="ingredient")
     */
    public function index()
    {
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

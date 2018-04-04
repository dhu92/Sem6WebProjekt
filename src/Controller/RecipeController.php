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
        //$this->denyAccessUnlessGranted('ROLE_USER', null, 'You have to be logged in.');
        $entityManager = $this ->getDoctrine()->getManager();
        $entityManager->persist($data);
        $entityManager->flush();
    }

    private function getById($id){
        $data = $this->getDoctrine()->getRepository(Recipe::class)->find($id);
        if (!$data) {
            throw $this->createNotFoundException(
                'No product found for id '.$id
            );
        }
        return $data;
    }
}

<?php

namespace App\Controller;

use App\Entity\Language;
use App\Entity\RecipeTranslation;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class RecipeTranslationController extends Controller
{
    /**
     * @Route("/recipe/translation", name="recipe_translation")
     */
    public function index()
    {
        $response = $this->render('recipe_translation/index.html.twig', [
            'controller_name' => 'RecipeTranslationController',
        ]);

        // cache for 3600 seconds
        $response->setSharedMaxAge(3600);

        // (optional) set a custom Cache-Control directive
        $response->headers->addCacheControlDirective('must-revalidate', true);

        return $response;
    }

    private function save($data){
        $entityManager = $this ->getDoctrine()->getManager();
        $entityManager->persist($data);
        $entityManager->flush();
    }

    public function loadAll(){
        $allLanguages = $this->getDoctrine()->getRepository(Language::class)->findAll();
    }

    private function getById($id){
        $data = $this->getDoctrine()->getRepository(RecipeTranslation::class)->find($id);
        if (!$data) {
            throw $this->createNotFoundException(
                'No product found for id '.$id
            );
        }
        return $data;
    }
}

<?php

namespace App\Controller;

use App\Form\IngredientType;
use App\Entity\Ingredient;
use App\Entity\IngredientTranslation;
use App\Entity\Language;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class IngredientController extends Controller
{
    /**
     *
     * @Route("/ingredient", name="ingredient")
     */
    public function index(Request $request)
    {

        $form = $this->createForm(IngredientType::class);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            //anstelle von recipeData die Entity verwenden um Daten in die DB zu schreiben
            //hier könnte z.b. mit recipeData[name] auf den Namen zugegriffen werden
            $formData = $form->getData();
            dump($formData);
            $this->save($formData);
            //dump funktioniert wie sysout nur zeigt es die Informationen direkt auf der Seite an

        }

        $response = $this->render('ingredient/index.html.twig', [
            'controller_name' => 'IngredientController',
            'ingredient_form' => $form->createView()]);
        // cache for 3600 seconds
        $response->setSharedMaxAge(3600);
//         (optional) set a custom Cache-Control directive
        $response->headers->addCacheControlDirective('must-revalidate', true);

        return $response;
    }

    private function save($data){
        $ingredient = new Ingredient();
        $entityManager = $this ->getDoctrine()->getManager();
        $entityManager->persist($ingredient);
        $entityManager->flush();

        $german = new IngredientTranslation();
        $german->setLanguage($this->getLanguageByName("German"));
        $german->setName($data['name_in_german']);
        $german->setIngredientID($ingredient);

        dump($german);

        $english = new IngredientTranslation();
        $english->setLanguage($this->getLanguageByName("English"));
        $english->setName($data['name_in_english']);
        $english->setIngredientID($ingredient);

        $entityManager->persist($german);
        $entityManager->flush();
        $entityManager->persist($english);
        $entityManager->flush();

    }

    public function loadAll(){
        $allLanguages = $this->getDoctrine()->getRepository()->findAll();
    }

    private function getById($id){
        $data = $this->getDoctrine()->getRepository(Ingredient::class)->find($id);
        if (!$data) {
            throw $this->createNotFoundException(
                'No product found for id '.$id
            );
        }
        return $data;
    }

    public function getLanguageByID($id){
        $data = $this->getDoctrine()->getRepository(Language::class)->find($id);
        if (!$data) {
            throw $this->createNotFoundException(
                'No product found for id '.$id
            );
        }
        return $data;
    }

    public function getLanguageByName($name){
        $data = $this->getDoctrine()->getRepository(Language::class)->findAll();
        foreach($data as $entity){
            if(strcmp($entity->getName(), $name) == 0){
                return $entity;
            }
        }
        return null;
    }
}

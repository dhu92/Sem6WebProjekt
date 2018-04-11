<?php

namespace App\Controller;

use App\Form\IngredientType;
use App\Entity\Ingredient;
use App\Entity\IngredientTranslation;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class IngredientController extends Controller
{
    /**
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
            $this->save($formData);
            //dump funktioniert wie sysout nur zeigt es die Informationen direkt auf der Seite an
            //dump($formData);

        }

        return $this->render('ingredient/index.html.twig', [
            'controller_name' => 'IngredientController',
            'ingredient_form' => $form->createView()
        ]);
    }

    private function save($data){
        $ingredient = new Ingredient();

        dump($data);
        $entityManager = $this ->getDoctrine()->getManager();
        $entityManager->persist($ingredient);
        $entityManager->flush();

        $id = $ingredient->getId();

        $german = new IngredientTranslation();
        $german->setLanguage("German");
        $german->setName($data["Name_in_Deutsch"]);
        $german->setIngredientID($id);

        $english = new IngredientTranslation();
        $english->setLanguage("English");
        $english->setName($data["Name_in_English"]);
        $english->setIngredientID($id);

        $iTranslationController = new IngredientTranslationController();
        $iTranslationController->save($german);
        $iTranslationController->save($english);
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
}

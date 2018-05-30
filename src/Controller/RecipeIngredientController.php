<?php

namespace App\Controller;

use App\Entity\RecipeIngredient;
use App\Form\IngredientType;
use App\Form\RecipeBaseType;
use App\Form\RecipeFormType;
use App\Form\RecipeIngredientType;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\FormBuilderInterface;
use App\Entity\IngredientTranslation;
use Symfony\Component\Validator\Constraints\Collection;

class RecipeIngredientController extends Controller
{


    public $recipeform;
    /**
     * @Route("/recipe/ingredient", name="recipe_ingredient")
     */
    public function index(Request $request)
    {
        $recipeform = $this->createForm(RecipeFormType::class);

        $recipeform->handleRequest($request);

        if($recipeform->isSubmitted() && $recipeform->isValid()){

            $this->addFlash('success', 'Recipe added successfully');
            return $this->redirectToRoute('recipe_ingredient');
        }

        return $this->addIngredientController($request, "setIngredient", $recipeform);
    }

    public function homeAction(Request $request){
        return
            $this->addIngredientController($request, 'setIngredient', $this->recipeform);

    }

    protected function addIngredientController(Request $request, $name, $rform)
    {
        $baseForm = $this->createForm(RecipeBaseType::class);
//        $form = $this
//            ->get('form.factory')
//
//            ->createNamedBuilder('setIngredient', FormType::class, new IngredientTranslation())
//            ->add('ingredients', CollectionType::class, [
//                'entry_type'   => RecipeFormType::class,
//                'label'        => 'List and order your ingredients by preference.',
//                'allow_add'    => true,
//                'allow_delete' => true,
//                'prototype'    => true,
//                'required'     => false,
//                'attr'   =>  [
//                    'class' => 'setIngredient-collection',
//                ],
//            ])
//            ->add('submit', SubmitType::class)
//            ->getForm()
//        ;

        //TODO check if clause
        if($baseForm->isSubmitted() && $baseForm->isValid()){
            $baseFormData = $baseForm->getData();
            //dump funktioniert wie sysout nur zeigt es die Informationen direkt auf der Seite an
            dump($baseFormData);

        }


        return $this->render('recipe_ingredient/index.html.twig', [
            'controller_name' => 'RecipeIngredientController',
            'recipe_form' => $baseForm->createView()
        ]);


    }

    private function save($data){
        $entityManager = $this ->getDoctrine()->getManager();
        $entityManager->persist($data);
        $entityManager->flush();
    }

    public function loadAll() : Collection{
        $allIngredientTranslations = $this->getDoctrine()->getRepository()->findAll();
            return $allIngredientTranslations;
    }

    private function getById($id){
        $data = $this->getDoctrine()->getRepository(RecipeIngredient::class)->find($id);
        if (!$data) {
            throw $this->createNotFoundException(
                'No product found for id '.$id
            );
        }
        return $data;
    }
}

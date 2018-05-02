<?php

namespace App\Controller;

use App\Entity\RecipeIngredient;
use App\Form\RecipeFormType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\FormBuilderInterface;
use App\Entity\IngredientTranslation;

class RecipeIngredientController extends Controller
{
    /**
     * @Route("/recipe/ingredient", name="recipe_ingredient")
     */
    public function index(Request $request)
    {
        $form = $this->createForm(RecipeFormType::class);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            //anstelle von recipeData die Entity verwenden um Daten in die DB zu schreiben
            //hier könnte z.b. mit recipeData[name] auf den Namen zugegriffen werden
            $formData = $form->getData();

            //dump funktioniert wie sysout nur zeigt es die Informationen direkt auf der Seite an
            //dump($recipeData);
            /*$data = new RecipeIngredient();
            $data->setAmount($formData['amount']);
            $data->setMeasurement($formData['measurement]);
            $this->>save($data);*/
            $this->addFlash('success', 'Recipe added successfully');
            return $this->redirectToRoute('recipe_ingredient');
        }
/*
        return $this->render('recipe_ingredient/index.html.twig', [
            'controller_name' => 'RecipeIngredientController',
            'recipe_form' => $form->createView()
        ]);*/
        return $this->addIngredientController($request, "setIngredient");
    }

    public function homeAction(Request $request){
        return //array_merge(
            $this->addIngredientController($request, 'setIngredient');
       // );
    }

    protected function addIngredientController(Request $request, $name)
    {
        $trans = new IngredientTranslation();
        $trans->setLanguage("german");
        $trans->setName("testname");
        $fdata = [
            'ingredients' => [
                $trans,
                new IngredientTranslation("Apple"),
                new IngredientTranslation("Banana"),
                new IngredientTranslation("Orange")

            ]
        ];
        dump($fdata);

        $form = $this
            ->get('form.factory')
            ->createNamedBuilder($name, FormType::class, $fdata)
            ->add('ingredients', CollectionType::class, [
                'entry_type'   => RecipeFormType::class,
                'label'        => 'List and order your ingredients by preference.',
                'allow_add'    => true,
                'allow_delete' => true,
                'prototype'    => true,
                'required'     => false,
                'attr'   =>  [
                    'class' => 'setIngredient-collection',
                ],
            ])
            ->add('submit', SubmitType::class)
            ->getForm()
        ;

       // $form->handleRequest($request);
       /* if ($form->isValid()) {
            $data = $form->getData();
        }*/

        return $this->render('recipe_ingredient/index.html.twig', [
            'controller_name' => 'RecipeIngredientController',
            'setIngredientData' => $fdata,
            'ingredient_form' => $form->createView(),

        ]);
        /*return [
            $name         => $form->createView(),
            "setIngredientData" => $data,
        ];
*/

    }


    private function save($data){
        $entityManager = $this ->getDoctrine()->getManager();
        $entityManager->persist($data);
        $entityManager->flush();
    }

    public function loadAll(){
        $allLanguages = $this->getDoctrine()->getRepository()->findAll();
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

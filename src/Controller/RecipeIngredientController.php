<?php

namespace App\Controller;

use App\Entity\RecipeIngredient;
use App\Form\RecipeFormType;
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

            //anstelle von recipeData die Entity verwenden um Daten in die DB zu schreiben
            //hier könnte z.b. mit recipeData[name] auf den Namen zugegriffen werden
           // $formData = $recipeform->getData();

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
        return $this->addIngredientController($request, "setIngredient", $recipeform);
    }

    public function homeAction(Request $request){
        return //array_merge(
            $this->addIngredientController($request, 'setIngredient', $this->recipeform);
       // );
    }

    protected function addIngredientController(Request $request, $name, $rform)
    {
        $trans = new IngredientTranslation();
        $trans->setLanguage("german");
        $trans->setName("testname");
        $test1 = new IngredientTranslation();
        $test1->setName("Apple");
        $test2 = new IngredientTranslation();
        $test2->setName("Banana");
        $test3 = new IngredientTranslation();
        $test3->setName("Orange");
        $fdata = [
            'ingredients' => [
                $test1,
                $test2,
                $test3
            ]
        ];
        dump($fdata);
        $collection = new ArrayCollection();
        $collection->add($test1);
        $form = $this
            ->get('form.factory')
            ->createNamedBuilder('setIngredient', FormType::class, $test2)//, $fdata)
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


        return $this->render('recipe_ingredient/index.html.twig', [
            'controller_name' => 'RecipeIngredientController',
            'setIngredientData' => $fdata,
            'ingredient_form' => $form->createView(),
            'recipe_form' => $rform->createView()

        ]);


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

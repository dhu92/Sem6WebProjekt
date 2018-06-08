<?php

namespace App\Controller;

use App\Entity\Recipe;
use App\Entity\RecipeBase;
use App\Entity\RecipeForm;
use App\Entity\RecipeIngredient;
use App\Entity\RecipeTranslation;
use App\Event\RecipeCreatedEvent;
use App\Event\RecipeCreatedListener;
use App\Form\IngredientType;
use App\Form\RecipeBaseType;
use App\Form\RecipeFormType;
use App\Form\RecipeIngredientType;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\EventDispatcher\EventDispatcher;
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
//        $recipeform = $this->createForm(RecipeFormType::class);
//
//        $recipeform->handleRequest($request);
//
//        if($recipeform->isSubmitted() && $recipeform->isValid()){
//
//            $this->addFlash('success', 'Recipe added successfully');
//            return $this->redirectToRoute('recipe_ingredient');
//        }
//
//        return $this->addIngredientController($request, "setIngredient", $recipeform);

        $recipeBase = new RecipeBase();
        $baseForm = $this->createForm(RecipeBaseType::class, $recipeBase);
        $baseForm->handleRequest($request);

        if($baseForm->isSubmitted()){
            $baseFormData = $baseForm->getData();
            $this->save($baseFormData);
        }


        /*if($baseForm->isSubmitted() && $baseForm->isValid()){
            $baseFormData = $baseForm->getData();
            dump($baseFormData);
            //$this->save($baseFormData);
        }*/


        return $this->render('recipe_ingredient/index.html.twig', [
            'controller_name' => 'RecipeIngredientController',
            'recipe_form' => $baseForm->createView()
        ]);
    }

//    public function homeAction(Request $request){
//        return
//            $this->index($request);
//
//    }

    private function save($data){
        //save new recipe in Table recipe
        $recipe = new Recipe();
        $entityManager = $this ->getDoctrine()->getManager();
        $entityManager->persist($recipe);
        $entityManager->flush();

        $transport = (new \Swift_SmtpTransport('smtp.gmail.com', 465))
            ->setUsername('symfoniac2018@gmail.com')
            ->setPassword('loladin2018!')
        ;
        $mailer = new \Swift_Mailer($transport);
        $dispatcher = new EventDispatcher();

        $loader = new \Twig_Loader_Filesystem('../templates');
        $twig = new \Twig_Environment($loader, array(
            'cache' => '/path/to/compilation_cache',
        ));
        $listener = new RecipeCreatedListener($mailer, $twig);
        $dispatcher->addListener('recipe.created', array($listener, 'onRecipeCreated'));
        $event = new RecipeCreatedEvent($recipe);
        $dispatcher->dispatch(RecipeCreatedEvent::class, $event);
        //save ingrediants
        $elements = $data->getIngredient();
        foreach($elements as  $recipeIngredient){
            $recipeIngredient->setIngredientID($recipeIngredient->getIngredientID());
            $recipeIngredient->setRecipeID($recipe);

            $entityManager = $this ->getDoctrine()->getManager();
            $entityManager->persist($recipeIngredient);
            $entityManager->flush();
        }

        //save translation
        $recipeTranslation = new RecipeTranslation();
        $recipeTranslation->setLanguageID($data->getLanguage());
        $recipeTranslation->setName($data->getName());
        $recipeTranslation->setDescription($data->getDescription());
        $recipeTranslation->setDuration($data->getDuration());
        $recipeTranslation->setPreperation($data->getPreparation());
        $recipeTranslation->setRecipeID($recipe);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($recipeTranslation);
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

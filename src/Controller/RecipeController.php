<?php

namespace App\Controller;



use App\Event\RecipeCreatedEvent;
use App\Event\RecipeCreatedListener;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class RecipeController extends Controller
{
    /**
     * @Route("/recipe", name="recipe")
     */
    public function index()
    {
        $response = $this->render('recipe/index.html.twig', [
            'controller_name' => 'RecipeController',
        ]);
        // cache for 3600 seconds
        $response->setSharedMaxAge(3600);

        // (optional) set a custom Cache-Control directive
        $response->headers->addCacheControlDirective('must-revalidate', true);

        return $response;

    }

    private function save($data){
        //$this->denyAccessUnlessGranted('ROLE_USER', null, 'You have to be logged in.');
        $entityManager = $this ->getDoctrine()->getManager();
        $entityManager->persist($data);
        $entityManager->flush();
        //dispatch event to send email to admin
        //TODO check if data is a Recipe object,
        //Todo make dispatcher global usabal
        $dispatcher = new EventDispatcher();
        $event = new RecipeCreatedEvent($data);
        $dispatcher->dispatch(RecipeCreatedEvent::NAME, $event);
    }

    public function loadAll(){
        $allLanguages = $this->getDoctrine()->getRepository()->findAll();
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

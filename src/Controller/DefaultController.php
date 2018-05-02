<?php
/**
 * Created by PhpStorm.
 * User: ClemensB
 * Date: 07.03.18
 * Time: 10:46
 */

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/")
 */
class DefaultController{

    /**
     * @Route("/hello/{name}", name="hello")
     */
    public function index($name){
        $response =  $this->render('ingredient/index.html.twig', [
            'controller_name' => 'IngredientController',
        ]);

        // cache for 3600 seconds
        $response->setSharedMaxAge(3600);

        // (optional) set a custom Cache-Control directive
        $response->headers->addCacheControlDirective('must-revalidate', true);

        return $response;
    }
}
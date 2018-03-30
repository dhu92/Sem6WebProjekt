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
        return $this->render('ingredient/index.html.twig', [
            'controller_name' => 'IngredientController',
        ]);
    }
}
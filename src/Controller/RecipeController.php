<?php
/**
 * Created by PhpStorm.
 * User: ClemensB
 * Date: 14.03.18
 * Time: 09:08
 */

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RecipeController{


    public function list(){
        $this -> render('list.html.twig', ['recipes' => $this->loadAll(Recipes)]);
    }


    public function show($name){
       return new Response("Book name: " .$name);
    }
}
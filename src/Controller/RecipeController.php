<?php
/**
 * Created by PhpStorm.
 * User: ClemensB
 * Date: 14.03.18
 * Time: 09:08
 */

namespace App\Controller;

use App\Domain\Recipe;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/{_locale}/recipe")
 */
class RecipeController extends Controller {

    /**
     * @Route("/")
     */
    public function list(){
        $r1 = new Recipe();
        $r1 ->setName("apple");
        $r2 = new Recipe();
        $r2 ->setName("Test 2");
        $r3 = new Recipe();
        $r3 ->setName("Test 3");
        $recipes = [$r1, $r2, $r3];
        return $this -> render('recipes.html.twig', ['recipes' => $recipes, 'count' => 1]);
    }

    /**
     * @Route("/{name}")
     */
    public function show($name){
       return new Response("Book name: " .$name);
    }


}
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

class BookController{

    /**
     * @Route("/")
     */
    public function list(){
        return new Response("Hello");
    }

    /**
     * @Route("/book/{name}"
     */
    public function show($name){
       return new Response("Book name: " .$name);
    }
}
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
     * @Route("/hello/{name}")
     */
    public function index($name){
        return new Response('Hello Peoples ' .$name.'!!!');
    }
}
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
        /*$entityManager = $this->getDoctrine()->getManager();
        $ticket = new Ticker();
        $entityManager->persist($ticket);
        $entityManager->flush();*/

        //get data from db
        /*$r = $entityManager->getRepository(Ticket::class);
        $t = $r->find(2);  // or findBy*(message), findAll
        $t->setMessage('...');
        $entityManager->flush();
        */

        //delete entity
        /*
         * $entityManager->remove($ticket);
         * $entityManager->flush();
         */

        return new Response('Hello Peoples ' .$name.'!!!');
    }
}
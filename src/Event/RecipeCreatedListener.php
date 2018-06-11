<?php
/**
 * Created by PhpStorm.
 * User: bauer
 * Date: 23.05.2018
 * Time: 09:06
 */

namespace App\Event;


use App\Entity\Recipe;
use Twig\Environment;

class RecipeCreatedListener
{
    private $mailer;
    private $twig;

    public function __construct(\Swift_Mailer $mailer, \Twig_Environment $twig)
    {
        $this-> mailer = $mailer;
        $this-> twig = $twig;
    }

    public function onRecipeCreated(RecipeCreatedEvent $event){
        // Send Mail to admin via swiftmail
        //https://symfony.com/doc/current/email.html
        //used gmail
        //PW. loladin2018!
        //e-Mail symfoniac2018@gmail.com
        $id =  $event ->getRecipe();


        $message = (new \Swift_Message('New Recipe Added'))
            ->setFrom('symfoniac2018@gmail.com')
            ->setTo('christoph.bauer@students.fhv.at')
            ->setBody(
                $this -> twig -> render(
                    'email\recipeadded.html.twig',
                    array('id' => $id)
                ),
                'text\html'
            );

       $this ->mailer ->send($message);

    }

}
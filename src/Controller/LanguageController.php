<?php

namespace App\Controller;

use App\Entity\Language;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class LanguageController extends Controller
{
    /**
     * @Route("/language", name="language")
     */
    public function index()
    {
        $entityManager = $this->getDoctrine()->getManager();

        $language = new Language();
        $language->setName('German');
        $entityManager->persist($language);
        $entityManager->flush();
       /* return $this->render('language/index.html.twig', [
            'controller_name' => 'LanguageController',
        ]);*/
       return new Response('Saved german language');
    }

    /**
     * @Route("/getlanguage/{id}", name="getlanguage")
     */
    public function getLanguages($id){
        $language = $this->getDoctrine()->getRepository(Language::class)->find($id);
        if(!$language){
            throw $this->createNotFoundException(
                'No language found'
            );
        }
        return new Response('Check out this great language: '.$language->getName());

    }
}

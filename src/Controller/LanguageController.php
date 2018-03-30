<?php

namespace App\Controller;

use App\Entity\Language;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class LanguageController extends Controller
{
    /**
     * @Route("/addlanguage/{name}", name="addlanguage")
     */
    public function addLanguage($name)
    {
        $entityManager = $this->getDoctrine()->getManager();

        $language = new Language();
        $language->setName($name);
        $entityManager->persist($language);
        $entityManager->flush();
       /* return $this->render('language/index.html.twig', [
            'controller_name' => 'LanguageController',
        ]);*/
       return new Response('Saved '.$name.' language');
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

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
        $language = new Language();
        $language->setName($name);
        $this->save($language);
       /* return $this->render('language/index.html.twig', [
            'controller_name' => 'LanguageController',
        ]);*/
       return new Response('Saved '.$name.' language');
    }

    /**
     * @Route("/getlanguage/{id}", name="getlanguage")
     */
    public function getLanguages($id){
        $language = $this->getById($id);
        return new Response('Check out this great language: '.$language->getName());
    }

    private function save($data){
        $entityManager = $this ->getDoctrine()->getManager();
        $entityManager->persist($data);
        $entityManager->flush();
    }

    public function loadAll(){
        $allLanguages = $this->getDoctrine()->getRepository()->findAll();
    }

    private function getById($id){
        $data = $this->getDoctrine()->getRepository(Language::class)->find($id);
        if (!$data) {
            throw $this->createNotFoundException(
                'No product found for id '.$id
            );
        }
        return $data;
    }

    public function getByName($name){
        $data = $this->loadAll();
        foreach($data as $entity){
            if(strcmp($entity->getName(), $name)){
                return $entity;
            }
        }
        return null;
    }

}
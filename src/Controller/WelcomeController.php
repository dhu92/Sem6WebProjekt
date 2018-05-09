<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class WelcomeController extends Controller
{
    /**
     * @Route("/", name="welcome")
     */
    public function index()
    {
        $response = $this->render('welcome/index.html.twig', [
            'controller_name' => 'WelcomeController',
        ]);
        // cache for 3600 seconds
        $response->setSharedMaxAge(60);

        return $response;
    }
}

<?php
/**
 * Created by PhpStorm.
 * User: Christoph
 * Date: 04.04.2018
 * Time: 09:30
 */

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends Controller{
    /**
     * @Route("/login", name="login")
     */
    public function loginAction(Request $r, AuthenticationUtils $au) {
        // get the login error if there is one
        $error = $au->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $au->getLastUsername();

        return $this->render('security/index.html.twig', array(
            'last_username' => $lastUsername,
            'error'         => $error,
        ));
    }
}
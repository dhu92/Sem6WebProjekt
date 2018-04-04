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
     * @Route('/login', name='login')
     */
    public function loginAction(Request $r, AuthenticationUtils $au) {
        return $this->render('security/login.html.twig', [
            'last_username' => $au->getLastUsername(),
            'error' => $au->getLastAuthenticationError(),
        ]);
    }
}

/**
 * class SomeController extends Controller {
 * /**
 *  *   @Security("has_role('ROLE_ADMIN')")
 *  *\/
 *  public function fooAction()  ... }
 *
 *  OR
 *
 *  $this->denyAccessUnlessGranted('ROLE_ADMIN');
 *
 *  OBJECT LEVEL SECURITY
 *
 *  $this->denyAccessUnlessGranted('edit', $entity);
 *
 *  CHECK FOR RIGHT
 *
 *  $authorizationChecker->isGranted( ... , ... );
 *
 *  TWIG:
 *
 *  {% is_granted('ROLE_ADMIN')%}
 *
 * {% endif %}
 *
 *  VOTERS:
 *
 * class EntityVoter extends Voter {
 *      protected function supports($attribute, $subject) { ... }
 *
 *      protected function voteOnAttribute($attribute, $subject, $token) {
 *              if( ... ) {
 *                  return true;        //User allowed
 *              } else {
 *                  return false;       //User not allowed
 *              }
 *
 *              OR
 *
 *              if($decisionManager->decide($token, 'ROLE_ADMIN'))
 *                  return true;
 *              }
 *      }
 * }
 */
<?php
/**
 * Created by PhpStorm.
 * User: Christoph
 * Date: 23.05.2018
 * Time: 10:31
 */

namespace App\SymfoniacNewsletterBundle\Controller;


use App\Entity\Recipe;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class NewsletterController extends Controller
{
    public $newsletterHeader;
    private $newsletterContent;
    private $newsletterFooter;

    /**
     * @return mixed
     */
    public function getNewsletterHeader()
    {
        return $this->newsletterHeader;
    }

    /**
     * @param mixed $newsletterHeader
     */
    public function setNewsletterHeader($newsletterHeader): void
    {
        $this->newsletterHeader = $newsletterHeader;
    }

    /**
     * @return mixed
     */
    public function getNewsletterContent()
    {
        return $this->newsletterContent;
    }

    /**
     * @param mixed $newsletterContent
     */
    public function setNewsletterContent($newsletterContent): void
    {
        $this->newsletterContent = $newsletterContent;
    }

    /**
     * @return mixed
     */
    public function getNewsletterFooter()
    {
        return $this->newsletterFooter;
    }

    /**
     * @param mixed $newsletterFooter
     */
    public function setNewsletterFooter($newsletterFooter): void
    {
        $this->newsletterFooter = $newsletterFooter;
    }

    private function createContent() {
        $recipe = $this->getLatestRecipe();
        $this->setNewsletterContent($recipe->getTranslation());
    }

    private function getLatestRecipe() {
        $results = $this->getDoctrine()->getRepository(Recipe::class)->findBy(array(),array('id'=>'DESC'),0,1);
        return $results[0];
    }

    private function createHeader() {
        $user = $this->getUser();
        $this->setNewsletterHeader("Hello ".$user."!");
    }

    private function createFooter() {
        $this->setNewsletterFooter("We wish you a happy Day!");
    }
}
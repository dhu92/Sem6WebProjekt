<?php
/**
 * Created by PhpStorm.
 * User: Christoph
 * Date: 23.05.2018
 * Time: 10:31
 */

namespace SymfoniacNewsletterBundle\Controller;

header('Content-type: text/plain') ;

use App\Entity\Ingredient;
use App\Entity\IngredientTranslation;
use App\Entity\Recipe;
use App\Entity\RecipeIngredient;
use App\Entity\RecipeTranslation;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class NewsletterController extends Controller
{
    public $newsletterHeader;
    private $recipe;
    private $recipeTranslation;
    private $recipeIngredients;
    private $ingredients;

    private $newsletterContent;
    private $newsletterFooter;

    /**
     * @return mixed
     */
    public function getRecipe()
    {
        return $this->recipe;
    }

    /**
     * @param mixed $recipe
     */
    public function setRecipe($recipe): void
    {
        $this->recipe = $recipe;
    }

    /**
     * @return mixed
     */
    public function getRecipeTranslation()
    {
        return $this->recipeTranslation;
    }

    /**
     * @param mixed $recipeTranslation
     */
    public function setRecipeTranslation($recipeTranslation): void
    {
        $this->recipeTranslation = $recipeTranslation;
    }

    /**
     * @return mixed
     */
    public function getRecipeIngredients()
    {
        return $this->recipeIngredients;
    }

    /**
     * @param mixed $recipeIngredients
     */
    public function setRecipeIngredients($recipeIngredients): void
    {
        $this->recipeIngredients = $recipeIngredients;
    }

    /**
     * @return mixed
     */
    public function getIngredients()
    {
        return $this->ingredients;
    }

    /**
     * @param mixed $ingredients
     */
    public function setIngredients($ingredients): void
    {
        $this->ingredients = $ingredients;
    }

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
    public function setNewsletterFooter($newsletterFooter): void {
        $this->newsletterFooter = $newsletterFooter;
    }

    private function setLatestRecipe() {
        $recipe = $this->getDoctrine()
            ->getRepository(Recipe::class)
            ->findBy(array(), array('id'=>'DESC'));

        if (!$recipe) {
            throw $this->createNotFoundException(
                'No recipe found'
            );
        }

        $recipeTranslation = $this->getDoctrine()
            ->getRepository(RecipeTranslation::class)
            ->find($recipe[0]->getId());

        $recipeIngredients = $this->getDoctrine()
            ->getRepository(RecipeIngredient::class)
            ->findByRecipeID($recipe[0]->getId());

        dump($recipeIngredients);

        $ingredient = array();

        for ($x = 0; $x < sizeof($recipeIngredients); $x++) {
            $ingredient[$x] = $this->getDoctrine()
                ->getRepository((IngredientTranslation::class))
                ->findByIngredientID($recipeIngredients[$x]->getId())[0];
        }

        $this->setIngredients($ingredient);
        $this->setRecipeIngredients($recipeIngredients);
        $this->setRecipeTranslation($recipeTranslation);
        $this->setRecipe($recipe[0]);
    }

    private function createHeader() {
        $user = $this->getUser();
        $this->setNewsletterHeader("Hello ".$user->getUsername()."!");
    }

    private function createFooter() {
        $this->setNewsletterFooter("We wish you a happy Day!");
    }

    public function returnLastRecipe () {
        $this->setLatestRecipe();

        $ingredientString = "";

        for ($x = 0; $x < sizeof($this->recipeIngredients,1); $x++) {
            $ingredientString = $ingredientString.$this->ingredients[$x]->getName()
                ."\t\t".$this->recipeIngredients[$x]->getAmount()
                ."\t".$this->recipeIngredients[$x]->getMeasurement()
                ."\r\n";
        }

        return $this->recipeTranslation->getName()
                ."\r\n".$ingredientString
                ."\r\n".$this->recipeTranslation->getDescription()
                ."\r\n".$this->recipeTranslation->getPreperation()
                ."\r\n".$this->recipeTranslation->getDuration();


    }

    public function recentRecipe()
    {
        // make a database call or other logic
        // to get the "$max" most recent articles

        $this->createHeader();
        $this->createFooter();


        return $this->render('recipe/recent_list.html.twig',
            array('newsletterHeader' => $this->newsletterHeader,
                    'newsletterContent' => $this->returnLastRecipe(),
                    'newsletterFooter' => $this->newsletterFooter)
        );
    }
}
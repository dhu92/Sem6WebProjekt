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
use Symfony\Component\Config\Definition\Exception\Exception;

class NewsletterController extends Controller
{
    public $newsletterHeader;
    private $recipe;
    private $recipeTranslation;
    private $recipeIngredients;
    private $ingredients = array();

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

    private function getRecipes() {
        $recipe = $this->getDoctrine()
            ->getRepository(Recipe::class)
            ->findBy(array(), array('id'=>'DESC'));
        if (!$recipe) {
            return 0;
        } else {
            return array_slice($recipe, 0, 3);
        }
    }

    private function setLatestRecipe($offset) {
        $recipe = $this->getRecipes();

        $recipeTranslation = $this->getDoctrine()
            ->getRepository(RecipeTranslation::class)
            ->findByRecipeID($recipe[$offset]->getId());

        $recipeIngredients = $this->getDoctrine()
            ->getRepository(RecipeIngredient::class)
            ->findByRecipeID($recipe[$offset]->getId());

        for ($x = 0; $x < sizeof($recipeIngredients); $x++) {
            $ingredientForTranslation[$x] = $this->getDoctrine()
                ->getRepository(Ingredient::class)
                ->find($recipeIngredients[$x]->getIngredientID());
        }

        for ($y = 0; $y < sizeof($recipeIngredients); $y++) {
            $query = $this->getDoctrine()
                ->getRepository(IngredientTranslation::class)
                ->createQueryBuilder('it')
                    ->where('it.ingredientID = :ingredient') // AND it.language = :language')
                    ->setParameter(':ingredient', $ingredientForTranslation[$y]->getId())
                    //->setParameter(':language', 0)
                    ->getQuery();
            $ingredient[$y] = $query->setMaxResults(1)->getOneOrNullResult();
        }

        $this->setIngredients($ingredient);
        $this->setRecipeIngredients($recipeIngredients);
        $this->setRecipeTranslation($recipeTranslation[0]);
        $this->setRecipe($recipe[$offset]);
    }

    private function createHeader() {
        if (!$this->getUser()) {
            $user = "guest";
        }
        else {
            $user = $this->getUser()->getUsername();
        }
        $this->setNewsletterHeader("Hello ".$user."!\r\n");
    }

    private function createFooter() {
        $this->setNewsletterFooter("We wish you a happy Day!");
    }

    private function returnRecipe ($recipeText, $offset) {
        try {
            $this->setLatestRecipe($offset);

            $ingredientText = "";

            for ($x = 0; $x < sizeof($this->recipeIngredients); $x++) {
                $ingredientText = $ingredientText.$this->ingredients[$x]->getName()
                    . "\t\t" . $this->recipeIngredients[$x]->getAmount()
                    . "\t" . $this->recipeIngredients[$x]->getMeasurement()
                    . "\r\n";
            }

            return $this->recipeTranslation->getName()
                ."\r\n".$ingredientText
                ."\r\n".$this->recipeTranslation->getDescription()
                ."\r\n".$this->recipeTranslation->getPreperation()
                ."\r\n".$this->recipeTranslation->getDuration()
                ."\r\n--------------------------------\r\n"
                ."\r\n".$recipeText;

        } catch (Exception $exception) {
            if ($offset == 0) {
                return "No additional Recipes Found";
            } else {
                return $recipeText."\r\nNo additional Recipes Found";
            }
        }
    }

    private function returnLastRecipes($a) {
        $recipesText = "";
        $amount = 0;
        if ($this->getRecipes() == 0) {
            $recipesText = "No Recipies found!";
        }
        else {
            if (sizeof($this->getRecipes()) >= 3) {
                $amount = $a;
            } else {
                $amount = sizeof($this->getRecipes());
            }

            for ($x = 0; $x < $amount; $x++) {
                $recipesText = $this->returnRecipe($recipesText, $x);
            }
        }

        return $recipesText;
    }

    public function recentRecipe()
    {
        // make a database call or other logic
        // to get the "$max" most recent articles

        $this->createHeader();
        $this->createFooter();

        return $this->render('recipe/recent_list.html.twig',
            array('newsletterHeader' => $this->newsletterHeader,
                    'newsletterContent' => $this->returnLastRecipes(1),
                    'newsletterFooter' => $this->newsletterFooter)
        );
    }

    public function recentRecipes() {
        // make a database call or other logic
        // to get the "$max" most recent articles

        $this->createHeader();
        $this->createFooter();

        return $this->render('recipe/recent_list.html.twig',
            array('newsletterHeader' => $this->newsletterHeader,
                'newsletterContent' => $this->returnLastRecipes(3),
                'newsletterFooter' => $this->newsletterFooter)
        );
    }
}
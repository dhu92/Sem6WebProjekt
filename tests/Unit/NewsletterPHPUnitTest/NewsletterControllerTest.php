<?php
/**
 * Created by PhpStorm.
 * User: Christoph
 * Date: 06.06.2018
 * Time: 15:29
 */

namespace App\Tests\Unit\NewsletterIntegrationTest;

use App\Entity\Recipe;
use SymfoniacNewsletterBundle\Controller\NewsletterController;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class NewsletterControllerTest extends KernelTestCase
{
    /**
     * @runInSeparateProcess
     */
    public function testSetRecipe() {
        $newsletter = new NewsletterController();

        $recipeTest = new Recipe();
        $recipeTest->setId(1);
        $recipeTest->setTranslation(1);

        $newsletter->setRecipe($recipeTest);
        $this->assertEquals($recipeTest->getId(), $newsletter->getRecipe()->getId());
    }
}

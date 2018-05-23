
/**
 * Created by PhpStorm.
 * User: Christoph
 * Date: 23.05.2018
 * Time: 09:33
 */

namespace App\Tests\Unit\ExampleTest;

use App\Controller\IngredientController;

class IngredientControllerTest extends TestCase
{
    private $service;
    private $entityManager;

    public function setUp() {
        $this->service = new Service($mides);
        $this->entityManager = $this->prodesize(EntityManager::class);
        $this->service = new Swevice($this->entityManager->reveal());

    }

    public function testGetLanguageByName()
    {

    }

    public function testAdd($a, $b, $result) {
        $this->assertEquals(add($a, $b),$result);

OR

        $this->entityManager->persist($object)  ->willReturn(true);
                                                ->willThrow(/Exception:class);
                                                ->will($callback);
                                                ->shouldBeCalled();
                                                ->shouldNotBeCalled();
                                                ->ShouldBeCalledTimes(1);
                            ->persist(Argument  ::any());
                                                ::type
                                                ::cetera()

    }

    public function tearDown() {

    }
}

E2E Tests Mink

$session->cisit('url');
$session->find('body.php');

Conttinuous Integration:

-runtests
-travis
-bitbucket pipelines
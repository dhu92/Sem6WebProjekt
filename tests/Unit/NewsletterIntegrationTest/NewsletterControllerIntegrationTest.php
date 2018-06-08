<?php
/**
 * Created by PhpStorm.
 * User: Christoph
 * Date: 08.06.2018
 * Time: 11:32
 */

namespace App\Tests\Unit\NewsletterIntegrationTest;

use App\Entity\Recipe;
use Doctrine\DBAL\Driver\PDOException;
use PDO;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class NewsletterControllerIntegrationTest extends KernelTestCase
{
    public function testDBConnection()
    {
        try {
            $pdo = new PDO("pgsql:dbname=SymfRecipeDB;host=localhost;user=postgres;password=admin");
        foreach ($pdo->query('SELECT * from AppUser ') as $row) {
            print_r($row);
            $this->assertUser($row);
        }
        $dbh = null;
        } catch (PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
            die();
        }
    }

    public function assertUser($user) {
        $this->assertNotEmpty($user);
    }
}

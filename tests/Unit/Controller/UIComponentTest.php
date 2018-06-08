<?php
/**
 * Created by PhpStorm.
 * User: ClemensB
 * Date: 06.06.18
 * Time: 15:54
 */

namespace App\Tests\Unit\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;


class PostControllerTest extends WebTestCase{


    public function testResponse(){

        $client = static::createClient();

        $client->request('GET', '/login');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }


    public function testShowPost()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/login');

        $this->assertGreaterThan(
            0,
            $crawler->filter('html:contains("Username")')->count()
        );

        $this->assertGreaterThan(1, $crawler->filter('label')->count());


        $this->assertGreaterThan(
            0,
            $crawler->filter('html:contains("Password")')->count()
        );
    }

}

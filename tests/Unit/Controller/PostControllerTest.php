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

    public function testShowPost()
    {
        $client = static::createClient();

        $client->request('GET', '/');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }
}

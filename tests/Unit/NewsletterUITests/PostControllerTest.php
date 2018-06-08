<?php
/**
 * Created by PhpStorm.
 * User: ClemensB
 * Date: 06.06.18
 * Time: 15:54
 */

namespace App\Tests\Unit\NewsletterUITests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;


class PostControllerTest extends WebTestCase{

    /**
     * @dataProvider urlProvider
     */
    public function testShowPost($url)
    {
        $client = static::createClient();

        $client->request('GET', $url);

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

    public function urlProvider()
    {
        yield ['/login'];
        // ...
    }
}

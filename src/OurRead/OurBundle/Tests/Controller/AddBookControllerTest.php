<?php
/**
 * Created by PhpStorm.
 * User: povilas
 * Date: 5/18/15
 * Time: 10:43 PM
 */

namespace OurRead\OurBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AddBookControllerTest extends WebTestCase
{
    public function testAddBook ()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/addBook');

        $this->assertGreaterThan(
            0,
            $crawler->filter('html:contains("Fill book data by ISBN")')->count()
        );
    }

} 
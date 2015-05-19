<?php
/**
 * Created by PhpStorm.
 * User: povilas
 * Date: 5/18/15
 * Time: 10:36 PM
 */

namespace OurRead\OurBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class SearchResultControllerTest extends WebTestCase
{
    public function testSearchResult()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/searchResult?search=the+girl+on+the+train');

        $this->assertGreaterThan(
            0,
            $crawler->filter('html:contains("The Girl on the Train")')->count()
        );
    }
}

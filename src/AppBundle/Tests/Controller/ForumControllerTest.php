<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ForumControllerTest extends WebTestCase
{
    public function testList()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/foros');
    }

    public function testShow()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/foros/{slug}');
    }

}

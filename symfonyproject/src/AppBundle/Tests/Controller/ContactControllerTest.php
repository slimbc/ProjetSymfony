<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ContactControllerTest extends WebTestCase
{
    public function testShowcontactpage()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/contactPage');
    }

    public function testSendmessage()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/sendMessage');
    }

}

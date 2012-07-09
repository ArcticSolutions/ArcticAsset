<?php

namespace Arctic\AssetBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase
{
    private $client;

    public function setUp()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/login');

        $form = $crawler->selectButton('submit')->form(array(
            '_username'  => 'test_user',
            '_password'  => '1234',
        ));

        $client->submit($form);
        $client->followRedirects();
        $this->client = $client;
    }

    public function testIndex()
    {
        $crawler = $this->client->request('GET', '/');

        $this->assertEquals('ArcticAsset - Dashboard', $crawler->filter('title')->text());
    }
}

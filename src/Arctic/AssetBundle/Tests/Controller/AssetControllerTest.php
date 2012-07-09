<?php

namespace Arctic\AssetBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AssetControllerTest extends WebTestCase
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
        $crawler = $this->client->request('GET', '/assets');

        $this->assertEquals('ArcticAsset - Assets', $crawler->filter('title')->text());
    }

    public function testNewAssets()
    {
    	$crawler = $this->client->request('GET', '/new_asset');

        $this->assertEquals('ArcticAsset - Add new asset', $crawler->filter('title')->text());
    }
}

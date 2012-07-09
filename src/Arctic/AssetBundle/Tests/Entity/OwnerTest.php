<?php

namespace Arctic\AssetBundle\Tests\Entity;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Arctic\AssetBundle\Entity\Owner;
use Arctic\AssetBundle\Entity\Asset;

class OwnerTest extends WebTestCase
{
	/**
     * @var Arctic\AssetBundle\Entity\Asset
     */
    private static $asset;

    public static function setUpBeforeClass()
    {
        $asset = new Asset();
        $asset->setSerialnumber('Th9Beste');
    	$asset->setProductnumber('mE4ethas');
        self::$asset = $asset;
    }

    public function testCreateNewOwner()
    {
    	$owner = new Owner();
        $owner->setName('Ola Nordman');
        $owner->setDescription('N/A');
        $owner->addAsset(self::$asset);

        $assets = $owner->getAssets();

		$this->assertNull($owner->getId());
    	$this->assertEquals('Ola Nordman', $owner->getName());
        $this->assertEquals('N/A', $owner->getDescription());
        $this->assertEquals(self::$asset, $assets[0]);
    }
}

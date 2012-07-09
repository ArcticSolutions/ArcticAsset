<?php

namespace Arctic\AssetBundle\Tests\Entity;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Arctic\AssetBundle\Entity\Type;
use Arctic\AssetBundle\Entity\Asset;

class TypeTest extends WebTestCase
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

    public function testCreateNewType()
    {
    	$type = new Type();
    	$type->setMake('Dell');
        $type->setModel('Latitude');
        $type->addAsset(self::$asset);

        $assets = $type->getAssets();

		$this->assertNull($type->getId());
    	$this->assertEquals('Dell', $type->getMake());
        $this->assertEquals('Latitude', $type->getModel());
        $this->assertEquals(self::$asset, $assets[0]);
    }
}

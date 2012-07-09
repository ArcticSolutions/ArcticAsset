<?php

namespace Arctic\AssetBundle\Tests\Entity;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Arctic\AssetBundle\Entity\Asset;
use Arctic\AssetBundle\Entity\Owner;
use Arctic\AssetBundle\Entity\Type;

class AssetTest extends WebTestCase
{
	/**
     * @var Arctic\AssetBundle\Entity\Owner
     */
    private static $owner;

    /**
     * @var Arctic\AssetBundle\Entity\Type
     */
    private static $type;

    public static function setUpBeforeClass()
    {
        $owner = new Owner();
        $owner->setName('Ola Nordman');
        $owner->setDescription('N/A');
        self::$owner = $owner;

        $type = new Type();
        $type->setMake('Dell');
        $type->setModel('Latitude');
        self::$type = $type;
    }

    public function testCreateNewEntity()
    {
    	$asset = new Asset();
    	$asset->setSerialnumber('Th9Beste');
    	$asset->setProductnumber('mE4ethas');
    	$asset->setOwner(self::$owner);
    	$asset->setType(self::$type);

		$this->assertNull($asset->getId());
    	$this->assertEquals('Th9Beste', $asset->getSerialnumber());
        $this->assertEquals('mE4ethas', $asset->getProductnumber());
        $this->assertEquals(self::$owner, $asset->getOwner());
        $this->assertEquals(self::$type, $asset->getType());
    }
}

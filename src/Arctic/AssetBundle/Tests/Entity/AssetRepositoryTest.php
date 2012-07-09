<?php

namespace Arctic\AssetBundle\Tests\Entity;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Arctic\AssetBundle\Entity\AssetRepository;
use Arctic\AssetBundle\Entity\Asset;

class AssetRepositoryTest extends WebTestCase
{
    /**
     * @var \Doctrine\ORM\EntityManager
     */
    private $em;

    public function setUp()
    {
        $kernel = static::createKernel();
        $kernel->boot();
        $this->em = $kernel->getContainer()->get('doctrine.orm.entity_manager');
    }


    public function testCreateNewAssetRepository()
    {
    	$assetRepository = $this->em->getRepository('ArcticAssetBundle:Asset');

        $this->assertTrue($assetRepository instanceof AssetRepository);
    }
}

<?php

namespace Arctic\AssetBundle\Tests\Entity;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Arctic\AssetBundle\Entity\OwnerRepository;
use Arctic\AssetBundle\Entity\Owner;

class OwnerRepositoryTest extends WebTestCase
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


    public function testCreateNewOwnerRepository()
    {
    	$ownerRepository = $this->em->getRepository('ArcticAssetBundle:Owner');

        $this->assertTrue($ownerRepository instanceof OwnerRepository);
    }
}

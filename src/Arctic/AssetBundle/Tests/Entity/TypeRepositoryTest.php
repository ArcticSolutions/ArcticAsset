<?php

namespace Arctic\AssetBundle\Tests\Entity;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Arctic\AssetBundle\Entity\TypeRepository;
use Arctic\AssetBundle\Entity\Type;

class TypeRepositoryTest extends WebTestCase
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


    public function testCreateNewTypeRepository()
    {
    	$typeRepository = $this->em->getRepository('ArcticAssetBundle:Type');

        $this->assertTrue($typeRepository instanceof TypeRepository);
    }
}

<?php

namespace Arctic\AssetBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Arctic\AssetBundle\Entity\Owner
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Arctic\AssetBundle\Entity\OwnerRepository")
 */
class Owner
{
    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string $name
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var text $description
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @ORM\OneToMany(targetEntity="Asset", mappedBy="owner")
     */
    private $assets;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set description
     *
     * @param text $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * Get description
     *
     * @return text 
     */
    public function getDescription()
    {
        return $this->description;
    }
    public function __construct()
    {
        $this->assets = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Add assets
     *
     * @param Arctic\AssetBundle\Entity\Asset $assets
     */
    public function addAsset(\Arctic\AssetBundle\Entity\Asset $assets)
    {
        $this->assets[] = $assets;
    }

    /**
     * Get assets
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getAssets()
    {
        return $this->assets;
    }
}
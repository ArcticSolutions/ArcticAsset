<?php

namespace Arctic\AssetBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Arctic\AssetBundle\Entity\Type
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Arctic\AssetBundle\Entity\TypeRepository")
 */
class Type
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
     * @var string $make
     *
     * @ORM\Column(name="make", type="string", length=255)
     */
    private $make;

    /**
     * @var string $model
     *
     * @ORM\Column(name="model", type="string", length=255)
     */
    private $model;

    /**
     * @ORM\OneToMany(targetEntity="Asset", mappedBy="type")
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
     * Set make
     *
     * @param string $make
     */
    public function setMake($make)
    {
        $this->make = $make;
    }

    /**
     * Get make
     *
     * @return string 
     */
    public function getMake()
    {
        return $this->make;
    }

    /**
     * Set model
     *
     * @param string $model
     */
    public function setModel($model)
    {
        $this->model = $model;
    }

    /**
     * Get model
     *
     * @return string 
     */
    public function getModel()
    {
        return $this->model;
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
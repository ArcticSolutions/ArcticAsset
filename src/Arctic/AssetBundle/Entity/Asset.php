<?php

namespace Arctic\AssetBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Arctic\AssetBundle\Entity\Asset
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Arctic\AssetBundle\Entity\AssetRepository")
 */
class Asset
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
     * @var string $serialnumber
     *
     * @ORM\Column(name="serialnumber", type="string", length=255, unique=true)
     */
    private $serialnumber;

    /**
     * @var string $productnumber
     *
     * @ORM\Column(name="productnumber", type="string", length=255)
     */
    private $productnumber;

    /**
     * @ORM\ManyToOne(targetEntity="Owner", inversedBy="assets")
     * @ORM\JoinColumn(name="owner_id", referencedColumnName="id")
     */
    private $owner;

    /**
     * @ORM\ManyToOne(targetEntity="Type", inversedBy="assets")
     * @ORM\JoinColumn(name="type_id", referencedColumnName="id")
     */
    private $type;


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
     * Set serialnumber
     *
     * @param string $serialnumber
     */
    public function setSerialnumber($serialnumber)
    {
        $this->serialnumber = $serialnumber;
    }

    /**
     * Get serialnumber
     *
     * @return string 
     */
    public function getSerialnumber()
    {
        return $this->serialnumber;
    }

    /**
     * Set productnumber
     *
     * @param string $productnumber
     */
    public function setProductnumber($productnumber)
    {
        $this->productnumber = $productnumber;
    }

    /**
     * Get productnumber
     *
     * @return string 
     */
    public function getProductnumber()
    {
        return $this->productnumber;
    }

    /**
     * Set owner
     *
     * @param object $owner
     */
    public function setOwner($owner)
    {
        $this->owner = $owner;
    }

    /**
     * Get owner
     *
     * @return object 
     */
    public function getOwner()
    {
        return $this->owner;
    }

    /**
     * Set type
     *
     * @param object $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * Get type
     *
     * @return object 
     */
    public function getType()
    {
        return $this->type;
    }
}
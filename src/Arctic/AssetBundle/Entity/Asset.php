<?php

namespace Arctic\AssetBundle\Entity;

use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Arctic\AssetBundle\Entity\Asset
 *
 * @ORM\Table(indexes={@ORM\Index(name="productnumber_idx", columns={"productnumber"})})
 * @ORM\Entity(repositoryClass="Arctic\AssetBundle\Entity\AssetRepository")
 * @UniqueEntity("serialnumber")
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
     * @var \DateTime $created
     *
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(name="created", type="datetime")
     */
    private $created;

    /**
     * @var \DateTime $updated
     *
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column(name="updated", type="datetime")
     */
    private $updated;

    /**
     * @var string $serialnumber
     *
     * @ORM\Column(name="serialnumber", type="string", length=255, unique=true)
     * @Assert\NotBlank
     */
    private $serialnumber;

    /**
     * @var string $productnumber
     *
     * @ORM\Column(name="productnumber", type="string", length=255, nullable=true)
     */
    private $productnumber;

    /**
     * @var string $tag
     *
     * @ORM\Column(name="tag", type="string", length=255, nullable=true)
     */
    private $tag;

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
     * @ORM\OneToMany(targetEntity="Arctic\TicketBundle\Entity\Ticket", mappedBy="asset")
     */
    private $tickets;

    public function __toString()
    {
        return sprintf('%s (%s)', $this->owner->getName(), $this->serialnumber);
    }

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

    /**
     * Set created
     *
     * @param \DateTime $created
     * @return Asset
     */
    public function setCreated($created)
    {
        $this->created = $created;
    
        return $this;
    }

    /**
     * Get created
     *
     * @return \DateTime 
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Set updated
     *
     * @param \DateTime $updated
     * @return Asset
     */
    public function setUpdated($updated)
    {
        $this->updated = $updated;
    
        return $this;
    }

    /**
     * Get updated
     *
     * @return \DateTime 
     */
    public function getUpdated()
    {
        return $this->updated;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->tickets = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Add tickets
     *
     * @param Arctic\TicketBundle\Entity\Ticket $tickets
     * @return Asset
     */
    public function addTicket(\Arctic\TicketBundle\Entity\Ticket $tickets)
    {
        $this->tickets[] = $tickets;
    
        return $this;
    }

    /**
     * Remove tickets
     *
     * @param Arctic\TicketBundle\Entity\Ticket $tickets
     */
    public function removeTicket(\Arctic\TicketBundle\Entity\Ticket $tickets)
    {
        $this->tickets->removeElement($tickets);
    }

    /**
     * Get tickets
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getTickets()
    {
        return $this->tickets;
    }

    /**
     * Set tag
     *
     * @param string $tag
     * @return Asset
     */
    public function setTag($tag)
    {
        $this->tag = $tag;
    
        return $this;
    }

    /**
     * Get tag
     *
     * @return string 
     */
    public function getTag()
    {
        return $this->tag;
    }
}
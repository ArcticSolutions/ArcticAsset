<?php

namespace Arctic\TicketBundle\Entity;

use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Arctic\TicketBundle\Entity\Ticket
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Arctic\TicketBundle\Entity\TicketRepository")
 */
class Ticket
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
     * @var string $subject
     *
     * @ORM\Column(name="subject", type="string", length=255)
     */
    private $subject;

    /**
     * @var integer $status
     *
     * @ORM\Column(name="status", type="integer")
     * @Assert\Choice(choices={1,2,3}, message="Choose a valid status.")
     */
    private $status;

    /**
     * @ORM\ManyToOne(targetEntity="Arctic\AssetBundle\Entity\Asset", inversedBy="tickets")
     * @ORM\JoinColumn(name="asset_id", referencedColumnName="id")
     */
    private $asset;

    /**
     * @ORM\ManyToOne(targetEntity="Arctic\UserBundle\Entity\User", inversedBy="tickets")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;

    /**
     * @ORM\OneToMany(targetEntity="Log", mappedBy="ticket")
     */
    private $logs;

    public function __construct()
    {
        $this->logs = new ArrayCollection();
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
     * Set created
     *
     * @param \DateTime $created
     * @return Ticket
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
     * @return Ticket
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
     * Set subject
     *
     * @param string $subject
     * @return Ticket
     */
    public function setSubject($subject)
    {
        $this->subject = $subject;
    
        return $this;
    }

    /**
     * Get subject
     *
     * @return string 
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * Set status
     *
     * @param integer $status
     * @return Ticket
     */
    public function setStatus($status)
    {
        $this->status = $status;
    
        return $this;
    }

    /**
     * Get status
     *
     * @return integer 
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set user
     *
     * @param Arctic\UserBundle\Entity\User $user
     * @return Ticket
     */
    public function setUser(\Arctic\UserBundle\Entity\User $user = null)
    {
        $this->user = $user;
    
        return $this;
    }

    /**
     * Get user
     *
     * @return Arctic\UserBundle\Entity\User 
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Add logs
     *
     * @param Arctic\TicketBundle\Entity\Log $logs
     * @return Ticket
     */
    public function addLog(\Arctic\TicketBundle\Entity\Log $logs)
    {
        $this->logs[] = $logs;
    
        return $this;
    }

    /**
     * Remove logs
     *
     * @param Arctic\TicketBundle\Entity\Log $logs
     */
    public function removeLog(\Arctic\TicketBundle\Entity\Log $logs)
    {
        $this->logs->removeElement($logs);
    }

    /**
     * Get logs
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getLogs()
    {
        return $this->logs;
    }

    /**
     * Set asset
     *
     * @param Arctic\AssetBundle\Entity\Asset $asset
     * @return Ticket
     */
    public function setAsset(\Arctic\AssetBundle\Entity\Asset $asset = null)
    {
        $this->asset = $asset;
    
        return $this;
    }

    /**
     * Get asset
     *
     * @return Arctic\AssetBundle\Entity\Asset 
     */
    public function getAsset()
    {
        return $this->asset;
    }
}
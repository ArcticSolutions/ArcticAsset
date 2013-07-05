<?php

namespace Arctic\UserBundle\Entity;

use FOS\UserBundle\Entity\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;

/**
* @ORM\Entity
* @ORM\Table(name="User")
*/
class User extends BaseUser
{
	/**
	* @ORM\Id
	* @ORM\Column(type="integer")
	* @ORM\GeneratedValue(strategy="AUTO")
	*/
	protected $id;

	/**
     * @var string $name
     *
     * @ORM\Column(name="name", type="string", length=255)
     * @Assert\NotBlank(message="Please enter your name.", groups={"Registration", "Profile"})
     * @Assert\Length(
     *      min = "3",
     *      max = "255",
     *      minMessage = "Your name must be at least {{ limit }} characters length",
     *      maxMessage = "Your name cannot be longer than {{ limit }} characters length"
     * )
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity="Arctic\TicketBundle\Entity\Ticket", mappedBy="user")
     */
    private $tickets;

    /**
     * @ORM\OneToMany(targetEntity="Arctic\TicketBundle\Entity\Log", mappedBy="user")
     */
    private $logs;

	public function __construct()
	{
		parent::__construct();

        $this->tickets = new ArrayCollection();
	}

    public function __toString()
    {
        return sprintf('%s', $this->name);
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
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Add tickets
     *
     * @param Arctic\TicketBundle\Entity\Ticket $tickets
     * @return User
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
     * Add logs
     *
     * @param Arctic\TicketBundle\Entity\Log $logs
     * @return User
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
}
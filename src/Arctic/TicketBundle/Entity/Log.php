<?php

namespace Arctic\TicketBundle\Entity;

use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;

/**
 * Arctic\TicketBundle\Entity\Log
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Arctic\TicketBundle\Entity\LogRepository")
 */
class Log
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
     * @var string $statement
     *
     * @ORM\Column(name="statement", type="text")
     */
    private $statement;

    /**
     * @ORM\ManyToOne(targetEntity="Arctic\UserBundle\Entity\User", inversedBy="logs")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity="Ticket", inversedBy="logs")
     * @ORM\JoinColumn(name="ticket_id", referencedColumnName="id")
     */
    private $ticket;

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
     * @return Log
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
     * Set user
     *
     * @param integer $user
     * @return Log
     */
    public function setUser($user)
    {
        $this->user = $user;
    
        return $this;
    }

    /**
     * Get user
     *
     * @return integer 
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set statement
     *
     * @param string $statement
     * @return Log
     */
    public function setStatement($statement)
    {
        $this->statement = $statement;
    
        return $this;
    }

    /**
     * Get statement
     *
     * @return string 
     */
    public function getStatement()
    {
        return $this->statement;
    }

    /**
     * Set ticket
     *
     * @param Arctic\TicketBundle\Entity\Ticket $ticket
     * @return Log
     */
    public function setTicket(\Arctic\TicketBundle\Entity\Ticket $ticket = null)
    {
        $this->ticket = $ticket;
    
        return $this;
    }

    /**
     * Get ticket
     *
     * @return Arctic\TicketBundle\Entity\Ticket 
     */
    public function getTicket()
    {
        return $this->ticket;
    }
}
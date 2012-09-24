<?php

namespace Arctic\TicketBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class TicketController extends Controller
{
    /**
     * @Route("/tickets")
     * @Template()
     */
    public function ticketsAction()
    {
        return array('title' => 'Tickets');
    }
}

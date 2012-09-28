<?php

namespace Arctic\TicketBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Arctic\TicketBundle\Entity\Log;
use Arctic\TicketBundle\Form\LogType;

/**
 * Log controller.
 *
 * @Route("/log")
 */
class LogController extends Controller
{
    /**
     * Creates a new Log entity.
     *
     * @Route("/create/{ticketId}", name="log_create")
     * @Method("POST")
     * @Template()
     */
    public function createAction(Request $request, $ticketId)
    {
        $em = $this->getDoctrine()->getManager();

        $ticket = $em->getRepository('ArcticTicketBundle:Ticket')->find($ticketId);

        $entity  = new Log();
        $entity->setTicket($ticket);
        $entity->setUser($this->getUser());
        $form = $this->createForm(new LogType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();
            $this->get('session')->getFlashBag()->add('success', 'Log was added');
        }

        return $this->redirect($this->generateUrl('ticket_show', array('id' => $ticketId)));
    }
}

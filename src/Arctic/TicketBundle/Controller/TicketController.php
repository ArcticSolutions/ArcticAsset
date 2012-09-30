<?php

namespace Arctic\TicketBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Arctic\TicketBundle\Entity\Ticket;
use Arctic\TicketBundle\Form\TicketType;
use Arctic\TicketBundle\Form\LogType;
use Arctic\AssetBundle\Form\AssetType;

/**
 * Ticket controller.
 *
 * @Route("/ticket")
 */
class TicketController extends Controller
{
    /**
     * Lists all Tickets.
     *
     * @Route("/", name="ticket")
     * @Route("/all", name="ticket_all")
     * @Route("/all/open", name="ticket_all_open")
     * @Template()
     */
    public function ticketsAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        if ($request->get('_route') == 'ticket_all') {
            $tickets = $em->getRepository('ArcticTicketBundle:Ticket')->getTicketsForListView(null, true);
        } elseif ($request->get('_route') == 'ticket_all_open') {
            $tickets = $em->getRepository('ArcticTicketBundle:Ticket')->getTicketsForListView();
        } else {
            $tickets = $em->getRepository('ArcticTicketBundle:Ticket')->getTicketsForListView($this->getUser()->getId());
        }

        $ticketsCount = $em->getRepository('ArcticTicketBundle:Ticket')->getTicketCount($this->getUser()->getId());

        return array(
            'title'         => 'Tickets',
            'tickets'       => $tickets,
            'tickets_count' => $ticketsCount
        );
    }

    /**
     * Finds and displays a Ticket entity.
     *
     * @Route("/{id}/show", name="ticket_show")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $ticket = $em->getRepository('ArcticTicketBundle:Ticket')->find($id);

        if (!$ticket) {
            throw $this->createNotFoundException('Unable to find Ticket.');
        }

        $ticketForm = $this->createForm(new TicketType(), $ticket);
        $assetForm = $this->createForm(new AssetType(), $ticket->getAsset());
        $logForm = $this->createForm(new LogType());
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'ticket'      => $ticket,
            'ticket_form' => $ticketForm->createView(),
            'log_form'    => $logForm->createView(),
            'asset_form'  => $assetForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to create a new Ticket entity.
     *
     * @Route("/new", name="ticket_new")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Ticket();
        $form   = $this->createForm(new TicketType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a new Ticket entity.
     *
     * @Route("/create", name="ticket_create")
     * @Method("POST")
     * @Template("ArcticTicketBundle:Ticket:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity  = new Ticket();
        $form = $this->createForm(new TicketType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('ticket_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Edits an existing Ticket entity.
     *
     * @Route("/{id}/update", name="ticket_update")
     * @Method("POST")
     * @Template("ArcticTicketBundle:Ticket:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ArcticTicketBundle:Ticket')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Ticket entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new TicketType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            $this->get('session')->getFlashBag()->add('success', 'Ticket was updated');
            return $this->redirect($this->generateUrl('ticket_show', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a Ticket entity.
     *
     * @Route("/{id}/delete", name="ticket_delete")
     * @Method("POST")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('ArcticTicketBundle:Ticket')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Ticket entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('ticket'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}

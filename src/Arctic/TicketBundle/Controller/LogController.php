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
     * Lists all Log entities.
     *
     * @Route("/", name="log")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('ArcticTicketBundle:Log')->findAll();

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Finds and displays a Log entity.
     *
     * @Route("/{id}/show", name="log_show")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ArcticTicketBundle:Log')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Log entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to create a new Log entity.
     *
     * @Route("/new", name="log_new")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Log();
        $form   = $this->createForm(new LogType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a new Log entity.
     *
     * @Route("/create/{ticketId}", name="log_create")
     * @Method("POST")
     * @Template("ArcticTicketBundle:Log:new.html.twig")
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
        }

        return $this->redirect($this->generateUrl('ticket_show', array('id' => $ticketId)));
    }

    /**
     * Displays a form to edit an existing Log entity.
     *
     * @Route("/{id}/edit", name="log_edit")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ArcticTicketBundle:Log')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Log entity.');
        }

        $editForm = $this->createForm(new LogType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing Log entity.
     *
     * @Route("/{id}/update", name="log_update")
     * @Method("POST")
     * @Template("ArcticTicketBundle:Log:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ArcticTicketBundle:Log')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Log entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new LogType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('log_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a Log entity.
     *
     * @Route("/{id}/delete", name="log_delete")
     * @Method("POST")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('ArcticTicketBundle:Log')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Log entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('log'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}

<?php

namespace Arctic\AssetBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Arctic\AssetBundle\Entity\Owner;
use Arctic\AssetBundle\Form\OwnerType;

/**
 * Owner controller.
 *
 * @Route("/owner")
 */
class OwnerController extends Controller
{
    /**
     * Lists all Owner entities.
     *
     * @Route("/", name="owner")
     * @Template()
     */
    public function ownersAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('ArcticAssetBundle:Owner')->findAll();

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Finds and displays a Owner entity.
     *
     * @Route("/{id}/show", name="owner_show")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ArcticAssetBundle:Owner')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Owner entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to create a new Owner entity.
     *
     * @Route("/new", name="owner_new")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Owner();
        $form   = $this->createForm(new OwnerType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a new Owner entity.
     *
     * @Route("/create", name="owner_create")
     * @Method("POST")
     * @Template("ArcticAssetBundle:Owner:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity  = new Owner();
        $form = $this->createForm(new OwnerType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('owner_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Owner entity.
     *
     * @Route("/{id}/edit", name="owner_edit")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ArcticAssetBundle:Owner')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Owner entity.');
        }

        $editForm = $this->createForm(new OwnerType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing Owner entity.
     *
     * @Route("/{id}/update", name="owner_update")
     * @Method("POST")
     * @Template("ArcticAssetBundle:Owner:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ArcticAssetBundle:Owner')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Owner entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new OwnerType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('owner_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a Owner entity.
     *
     * @Route("/{id}/delete", name="owner_delete")
     * @Method("POST")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('ArcticAssetBundle:Owner')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Owner entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('owner'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
